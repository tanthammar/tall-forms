<?php

namespace Tanthammar\TallForms\Traits;

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
        $fieldsCollection = collect($this->fieldsToArray());
        $field = $fieldsCollection->firstWhere('key', $fieldKey) ?? $fieldsCollection->firstWhere('name', $fieldName);
        if (empty($field)) {
            $field = $fieldsCollection->filter(function ($item) use ($fieldName) {
                $exploded = explode('.', $fieldName);
                return (
                    Str::startsWith($item['key'], 'form_data.' . head($exploded))
                    && Str::endsWith($item['key'], last($exploded))
                );
            })->first();
        }
        return collect($field);
    }

    protected function getFieldType(string $fieldKey)
    {
        return $this->getFieldValueByKey($fieldKey, 'type');
    }

    protected function fieldsToArray(): array
    {
        $array = [];
        foreach ($this->fields() as $field) {
            if (filled($field)) {
                if (in_array($field->type, ['keyval', 'array'])) {
                    $array = array(...$array, ...$field->fieldToArray());
                } else {
                    $array[] = $field->fieldToArray(); //in BaseField and IsArrayField
                }
            }
        }
        return $array;
    }

    protected function fieldNames(): array
    {
        return $fieldNames = collect($this->fields())->map(function ($field) {
            return filled($field) ? $field->name : null;
        })->toArray();
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
    public function errorMessage($message, $key = '', $label = '')
    {
        $return = str_replace('form_data.', '', $message);
        return str_replace('form data.', '', $return);
//        return \Str::replaceFirst('form data.', '', $message);
    }

    public static function unique_words(string $scentence): string
    {
        return implode(' ', array_unique(explode(' ', $scentence)));
    }
}
