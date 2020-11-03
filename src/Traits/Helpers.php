<?php

namespace Tanthammar\TallForms\Traits;


use Illuminate\Support\Arr;
use stdClass;

trait Helpers
{
    //TODO expand method to include keyval and array fields
    //you cannot get rules for keyval or array fields with this method
    protected function getFieldValueByKey(string $fieldKey, string $fieldValue)
    {

        $fieldName = \Str::replaceFirst('form_data.', '', $fieldKey);
        $fieldsArray = $this->fieldsToArray();
        $field = collect($fieldsArray)->firstWhere('name', $fieldName) ?? collect($fieldsArray)->firstWhere('key', $fieldKey);
//        $field = Arr::first($fieldsArray, (fn($value) => $value['name'] === $fieldName)) ?? Arr::first($fieldsArray, (fn($value) => $value['key'] === $fieldKey));
        return optional($field)[$fieldValue];
    }

    protected function getFieldType(string $fieldKey)
    {
        return $this->getFieldValueByKey($fieldKey, 'type');
    }

    //Does not convert Array or KeyVal fields, they remain as objects!!
    protected function fieldsToArray(): array
    {
        $array = [];
        foreach ($this->getFields() as $field) {
            if (filled($field)) $array[] = $field->fieldToArray(); //in BaseField and IsArrayField
        }
        return $array;
    }

    /**
     * Executes before field validation, creds to "@roni", livewire discord channel member
     * @param string $field
     * @param string $hook
     * @return string
     */
    protected function parseFunctionNameFrom(string $field, $hook = 'updated'): string
    {
        return $hook . \Str::of($field)->replace('.', '_')->studly()->replaceFirst('FormData', '');
    }



    public function tallFillField($array)
    {
        $this->form_data[$array['field']] = $array['value'];
    }

    // All other methods regarding tags are in Tanthammar\TallForms\SpatieTags
    // It's intended to be called in the onCreateModel() method, to sync tags after the model is created
    public function syncTags($field, $tagType = null)
    {
        $tags = data_get($this->custom_data, $field);
        if (filled($tags = explode(",", $tags)) && optional($this->model)->exists) {
            filled($tagType) ? $this->model->syncTagsWithType($tags, $tagType) : $this->model->syncTags($tags);
        }
    }

    // in blade views to strip "form data" from field validation
    public function errorMessage($message, $key='', $label='')
    {
        $return = str_replace('form_data.', '', $message);
        return str_replace('form data.', '', $return);
//        return \Str::replaceFirst('form data.', '', $message);
    }

    public static function unique_words(string $scentence): string
    {
        return implode(' ',array_unique(explode(' ', $scentence)));
    }

    /**
     * Returns only specified key/value pairs from the give array
     * and has deeply nested array support using "dot" notation for keys.
     * @param array $array
     * @param mixed $keys
     * @return array
     */
    public function arrayDotOnly(array $array, $keys): array
    {
        $newArray = [];
        $default = new stdClass;
        foreach ((array) $keys as $key) {
            $value = Arr::get($array, $key, $default);
            if ($value !== $default) {
                Arr::set($newArray, $key, $value);
            }
        }
        return $newArray;
    }

    /**
     * @return array
     */
    public function getNamesByFields(): array
    {
        return $this->getNamesByFieldsRecursively($this->fields());
    }

    /**
     *
     * @param array $fields
     * @param string $prefix
     * @return array
     */
    protected function getNamesByFieldsRecursively(array $fields, $prefix = ''): array
    {
        $fieldNames = [];
        $relationshipNames = [];
        $customNames = [];

        foreach ($fields as $field) {
            if (filled($field)) {
                if (property_exists($field, 'fields') && is_array($field->fields) && 0 < count($field->fields)) {
                    $results = $this->getNamesByFieldsRecursively($field->fields, $prefix . $field->name . '.');
                    $fieldNames = array_merge($fieldNames, $results['field_names']);
                    $relationshipNames = array_merge($relationshipNames, $results['relationship_names']);
                    $customNames = array_merge($customNames, $results['custom_names']);
                }
                if ($field->is_relation) {
                    $relationshipNames[] = $prefix . $field->name;
                } elseif ($field->is_custom) {
                    $customNames[] = $prefix . $field->name;
                } else {
                    $fieldNames[] = $prefix . $field->name;
                }
            }
        }

        return [
            'field_names' => $fieldNames,
            'relationship_names' => $relationshipNames,
            'custom_names' => $customNames,
        ];
    }

    /**
     *
     * @return array
     */
    protected function fieldNames(): array
    {
        return $this->fieldNamesRecursively($this->fields());
    }

    /**
     *
     * @param array $fields
     * @param string $prefix
     * @return array
     */
    protected function fieldNamesRecursively(array $fields, $prefix = ''): array
    {
        $fieldNames = [];

        foreach ($fields as $field) {
            if (filled($field)) {
                if (property_exists($field, 'fields') && is_array($field->fields) && 0 < count($field->fields)) {
                    $results = $this->fieldNamesRecursively($field->fields, $prefix . $field->name . '.');
                    $fieldNames = array_merge($fieldNames, $results);
                }
                $fieldNames[] = $prefix . $field->name;
            }
        }

        return $fieldNames;
    }

    /**
     *
     * @return array
     */
    protected function getFields(): array
    {
        return $this->getFieldsRecursively($this->fields());
    }

    /**
     *
     * @param array $fields
     * @param string $prefix
     * @return array
     */
    protected function getFieldsRecursively(array $fields, $prefix = ''): array
    {
        $results = [];

        foreach ($fields as $field) {
            if (filled($field)) {
                $key = (empty($prefix)) ? $field->key : $prefix . '.' . $field->name;
                if (property_exists($field, 'fields') && is_array($field->fields) && 0 < count($field->fields)) {
                    $results = array_merge($results, $this->getFieldsRecursively($field->fields, $key));
                }
                $field->key = $key;
                $results[] = $field;
            }
        }

        return $results;
    }
}
