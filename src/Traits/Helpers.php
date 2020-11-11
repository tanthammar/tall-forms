<?php

namespace Tanthammar\TallForms\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait Helpers
{
    protected function getFieldValueByKey(string $fieldKey, string $fieldValue)
    {
        return $this->collectField($fieldKey)->get($fieldValue);
    }

    protected function collectField(string $fieldKey)
    {
        $fieldName = Str::replaceFirst('form_data.', '', $fieldKey);
        $fieldsCollection = collect($this->getFields());
        $field = $fieldsCollection->firstWhere('key', $fieldKey) ?? $fieldsCollection->firstWhere('name', $fieldName);
        if (empty($field)) {
            $field = $fieldsCollection->filter(function ($item) use ($fieldName) {
                $exploded = explode('.', $fieldName);
                return (
                    Str::startsWith($item->key, 'form_data.' . head($exploded))
                    && Str::endsWith($item->key, last($exploded))
                );
            })->first();
        }
        return collect($field);
    }

    protected function getFieldType(string $fieldKey)
    {
        return $this->getFieldValueByKey($fieldKey, 'type');
    }

    /**
     * Executes before field validation, creds to "@roni", livewire discord channel member.
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
        data_set($this->form_data, $array['field'], $array['value']);
    }

    // All other methods regarding tags are in Tanthammar\TallForms\SpatieTags
    // It's intended to be called in the onCreateModel() method, to sync tags after the model is created
    public function syncTags($field, $tagType = null)
    {
        $tags = data_get($this->form_data, $field);
        if (filled($tags = explode(',', $tags)) && optional($this->model)->exists) {
            filled($tagType) ? $this->model->syncTagsWithType($tags, $tagType) : $this->model->syncTags($tags);
        }
    }

    public static function unique_words(string $scentence): string
    {
        return implode(' ', array_unique(explode(' ', $scentence)));
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
        foreach ((array)$keys as $key) {
            if (($value = Arr::get($array, $key)) !== null) Arr::set($newArray, $key, $value);
        }
        return $newArray;
    }

    protected function firstLevelFieldNames(): array
    {
        $fieldNames = [];
        foreach ($this->fields() as $field) {
            if (filled($field)) $fieldNames[] = $field->name;
        }
        return $fieldNames;
    }

    /**
     *
     * @param ?array|string $fields
     * @param string $prefix
     * @param bool $flatten
     * @return array
     */
    protected function getFields($fields = null, $prefix = '', bool $flatten = true): array
    {
        $fields = is_null($fields) || !is_array($fields) ? $this->fields() : $fields;
        $results = [];

        foreach ($fields as &$field) {
            if (filled($field)) {
                $fieldKey = (empty($prefix)) ? $field->key : $prefix . '.' . $field->name;
                $field->key = $fieldKey;
                $fieldKey = ($field->type === 'array') ? "{$fieldKey}.*" : $fieldKey;
                if (property_exists($field, 'fields') && is_array($field->fields) && 0 < count($field->fields)) {
                    $fieldResults = $this->getFields($field->fields, $fieldKey, $flatten);
                    if ($flatten) {
                        $results = array_merge($results, $fieldResults);
                    } else {
                        $field->fields = $fieldResults;
                    }
                }
                $results[] = $field;
            }
        }

        return $flatten ? $results : $fields;
    }

    protected function setFormPropertiesRecursively(array $fields)
    {
        foreach ($fields as $field) {
            if (filled($field)) {
                $fieldKey = str_replace('form_data.', '', $field->key);
                if (false === Str::contains($fieldKey, ['*']) && is_null(data_get($this->form_data, $fieldKey, null))) {
                    $array = (in_array($field->type, ['checkboxes', 'file']) || ($field->type === 'select' && $field->multiple));
                    data_set($this->form_data, $fieldKey, $field->default ?? ($array ? [] : null));
                    if (property_exists($field, 'fields') && is_array($field->fields) && 0 < count($field->fields)) {
                        $this->setFormPropertiesRecursively($field->fields);
                    }
                }
            }
        }
    }
}
