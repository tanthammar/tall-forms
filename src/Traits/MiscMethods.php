<?php

namespace Tanthammar\TallForms\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait MiscMethods
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

    /**
     * Fill fields from javascript: $wire.call('tallFillField', ['field' => ..., 'value' => ...])<br>
     * Fill fields from Livewire: $this->>emit(...), $this->>emitUp(...), $this->>emitTo(...), $this->>emitSelf(...)
     * The value will be validated in either updatedFoo() or on submit.
     */
    public function tallFillField(array $array)
    {
        data_set($this->form_data, $array['field'], $array['value']);
    }

    // All other methods regarding tags are in Tanthammar\TallForms\SpatieTags
    // It's intended to be called in the onCreateModel() method, to sync tags after the model is created
    protected function syncTags($field, $tagType = null)
    {
        $tags = data_get($this->form_data, $field);
        if (filled($tags = explode(',', $tags)) && optional($this->model)->exists) {
            filled($tagType) ? $this->model->syncTagsWithType($tags, $tagType) : $this->model->syncTags($tags);
        }
    }

    /**
     * Returns only specified key/value pairs from the given array
     * and has deeply nested array support using "dot" notation for keys.
     * @param array $array
     * @param mixed $keys
     * @return array
     */
    protected function arrayDotOnly(array $array, $keys): array
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
        foreach ($this->getFields() as $field) {
            if (!$field?->ignored && filled($field)) {
                $fieldNames[] = $field->name;
            }
            if ($field?->ignored && isset($field?->fields) && filled($field) && filled($field->fields)){
                foreach ($field->fields as $nested_field) {
                    $fieldNames[] = $nested_field->name;
                }
            }
        }
        return $fieldNames;
    }

    protected function getFieldsFlat(): array
    {
        if ($this->memoizedFieldsFlat === []) {
            $this->memoizedFieldsFlat = $this->recursiveFields(flatten: true);
        }
        return $this->memoizedFieldsFlat;
    }

    protected function getFieldsNested(): array
    {
        if ($this->memoizedFieldsNested === []) {
            $this->memoizedFieldsNested = $this->recursiveFields(flatten: false);
        }
        return $this->memoizedFieldsNested;
    }

    /**
     * Recursive
     * @param array|string|null $fields
     * @param string $prefix
     * @param bool $flatten
     * @return array
     */
    protected function recursiveFields(array|string|null $fields = null, string $prefix = '', bool $flatten = true): array
    {
        $fields = is_null($fields) || !is_array($fields) ? $this->getFields() : $fields;
        $results = [];

        foreach ($fields as &$field) {
            if (filled($field)) {
                $fieldKey = $field->ignored
                    ? ""
                    : (blank($prefix) ? $field->key : $prefix . '.' . $field->name);
                $field->key = $fieldKey;
                $fieldKey = ($field->type === 'array') ? "$fieldKey.*" : $fieldKey;
                if (isset($field->fields) && filled($field->fields)) {
                    $fieldResults = $this->recursiveFields($field->fields, $fieldKey, $flatten); //recursive
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
            if (!$field->ignored && filled($field)) {
                $fieldKey = Str::replaceFirst('form_data.', '', $field->key);
                if (false === Str::contains($fieldKey, ['*']) && is_null(data_get($this->form_data, $fieldKey, null))) {
                    data_set($this->form_data, $fieldKey, $field->default ?? ($field->has_array_value ? [] : null));
                }
            }
        }
    }
}
