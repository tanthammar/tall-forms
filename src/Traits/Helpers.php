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

    protected function collectField(string $fieldKey): \Illuminate\Support\Collection
    {
        $fieldName = Str::replaceFirst('form_data.', '', $fieldKey);
        $fieldsCollection = collect($this->getFieldsFlat());
        $field = $fieldsCollection->firstWhere('key', $fieldKey) ?? $fieldsCollection->firstWhere('name', $fieldName);
        if (blank($field)) {
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
     * Executes before field validation, creds to "@roni" and "@ra-V-en".
     */
    protected function parseFunctionNameFrom(string $field, string $hook = 'updated'): string
    {
        //return $hook . Str::of($field)->replace('.', '_')->studly()->replaceFirst('FormData', '');
        return $hook . Str::of(preg_replace('/(\d+)\./', '', $field))
                ->replace('.', '_')
                ->studly()
                ->replaceFirst('FormData', '');
    }

    /**
     * Returns the index of the field, if available
     */
    protected function getKeyIndexFrom(string $field): ?string
    {
        return Str::match('/(\d+)/', $field);
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
     * Returns only specified key/value pairs from the given array
     * and has deeply nested array support using "dot" notation for keys.
     * @param array $array
     * @param mixed $keys
     * @return array
     */
    public function arrayDotOnly(array $array, $keys): array
    {
        $newArray = [];
        foreach ((array)$keys as $key) {
            $value = Arr::get($array, $key);
            Arr::set($newArray, $key, $value);
        }
        return $newArray;
    }

    protected function firstLevelFieldNames(): array
    {
        $fieldNames = [];
        foreach ($this->fields as $field) {
            if (filled($field) && !$field->ignored) $fieldNames[] = $field->name;
            if (filled($field) && $field->ignored && isset($field->fields) && filled($field->fields)){
                foreach ($field->fields as $nested_field) {
                    $fieldNames[] = $nested_field->name;
                }
            }
        }
        return $fieldNames;
    }

    protected function getFieldsFlat(): array
    {
        return $this->getFields(null, '', true);
    }

    protected function getFieldsNested(): array
    {
        return $this->getFields(null, '', false);
    }

    /**
     * Recursive
     * @param ?array|string $fields
     * @param string $prefix
     * @param bool $flatten
     * @return array
     */
    protected function getFields($fields = null, $prefix = '', bool $flatten = true): array
    {
        $fields = is_null($fields) || !is_array($fields) ? $this->fields : $fields;
        $results = [];

        foreach ($fields as &$field) {
            if (filled($field)) {
                $fieldKey = $field->ignored
                    ? ""
                    : (blank($prefix) ? $field->key : $prefix . '.' . $field->name);
                $field->key = $fieldKey;
                $fieldKey = ($field->type === 'array') ? "$fieldKey.*" : $fieldKey;
                if (isset($field->fields) && filled($field->fields)) {
                    $fieldResults = $this->getFields($field->fields, $fieldKey, $flatten); //recursive
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

    protected function setFieldValues(array $fields) //expects flattened field list
    {
        foreach ($fields as $field) {
            if (filled($field) && !$field->ignored) {
                $fieldKey = Str::replaceFirst('form_data.', '', $field->key);
                if (false === Str::contains($fieldKey, ['*']) && is_null(data_get($this->form_data, $fieldKey, null))) {
                    $array = in_array($field->type, ['checkboxes', 'file', 'multiselect', 'input-array', 'tags']);
                    data_set($this->form_data, $fieldKey, $field->default ?? ($array ? [] : null));
                }
            }
        }
    }

    public static function mergeFilledToObject(array $defaults, array $custom): object
    {
        return (object)array_merge($defaults, array_filter($custom, fn ($var) => filled($var)));
    }

    public static function mergeFilledToArray(array $defaults, array $custom): array
    {
        return array_merge($defaults, array_filter($custom, fn ($var) => filled($var)));
    }
}
