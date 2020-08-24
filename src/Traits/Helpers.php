<?php

namespace Tanthammar\TallForms\Traits;


use Illuminate\Support\Arr;

trait Helpers
{
    protected function getFieldValueByKey(string $fieldKey, string $fieldValue)
    {

        $fieldName = \Str::replaceFirst('form_data.', '', $fieldKey);
        $fieldsArray = $this->fieldsToArray();
        $field = Arr::first($fieldsArray, (fn($value) => $value['name'] === $fieldName)) ?? Arr::first($fieldsArray, (fn($value) => $value['key'] === $fieldKey));
        return optional($field)[$fieldValue];
    }

    protected function getFieldType(string $fieldKey)
    {
        return $this->getFieldValueByKey($fieldKey, 'type');
    }

    protected function fieldsToArray(): array
    {
        $array = [];
        foreach ($this->fields() as $field) {
            if (filled($field)) $array[] = $this->dismount($field);
        }
        return $array;
    }

    protected function dismount($object): array
    {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }

    /**
     * Executes before field validation, creds to "@roni", livewire discord channel member
     * @param string $field
     * @return string
     */
    protected function parseUpdateFunctionFrom(string $field): string
    {
        return 'updated' . \Str::of($field)->replace('.', '_')->studly()->ltrim('FormData');
    }

    public function fillField($array)
    {
        $this->form_data[$array['field']] = $array['value'];
    }

    //all other methods regarding tags are in Tanthammar\TallForms\Tags\TagsTrait
    // This is used for action="create" forms, create() method, to sync tags after the model is created
    public function syncTags($field, $tagType = null)
    {
        $tags = data_get($this->custom_data, $field);
        if (filled($tags = explode(",", $tags)) && filled($this->model)) {
            filled($tagType) ? $this->model->syncTagsWithType($tags, $tagType) : $this->model->syncTags($tags);
        }
    }

    // in blade views to strip "form data" from field validation
    public function errorMessage($message)
    {
        return str_replace('form data.', '', $message);
    }
}
