<?php


namespace Tanthammar\TallForms\Traits;


trait ValidatesFields
{

    protected function get_rules()
    {
        $rules = [];
        foreach ($this->fields() as $field) {
            if ($field != null) {

                if (!in_array($field->type, ['array', 'keyval', 'file', 'select'])) $rules[$field->key] = $field->rules ?? 'nullable';

                if (in_array($field->type, ['array', 'keyval'])) {
                    foreach ($field->fields as $array_field) {
                        $key = $field->type === 'array'
                            ? "$field->key.*.$array_field->name"
                            : "$field->key.$array_field->name";
                        $rules[$key] = $array_field->rules ?? 'nullable';
                    }
                }
                if ($field->type === 'file') { //use field name here, for custom handling
                    $field->multiple
                        ? $rules["$field->name.*"] = $field->rules ?? 'nullable'
                        : $rules[$field->name] = $field->rules ?? 'nullable';
                }
                if ($field->type === 'select') {
                    $field->multiple
                        ? $rules["$field->key.*"] = $field->rules ?? 'nullable'
                        : $rules[$field->key] = $field->rules ?? 'nullable';
                }
            }
        }
        return $rules;
    }

    protected function validationAttributes()
    {
        $attributes = [];
        if ($this->labelsAsAttributes) {
            foreach ($this->fields() as $field) {
                if ($field != null && $field->labelAsAttribute) {
                    if (in_array($field->type, ['array', 'keyval'])) {
                        foreach ($field->fields as $array_field) {
                            $key = $field->type === 'array'
                                ? "$field->key.*.$array_field->name"
                                : "$field->key.$array_field->name";
                            $attributes[$key] = $array_field->label;
                        }
                    } else {
                        $attributes[$field->key] = $field->label;
                    }
                }
            }
        }
        return $attributes;
    }

    public function updated($field, $value)
    {
        $function = $this->parseFunctionNameFrom($field);
        if (method_exists($this, $function)) $this->$function($value);

        if (filled($fieldCollection = $this->collectField($field)) && $fieldCollection->get('realtimeValidationOn')) {
            $fieldRule = $fieldCollection->get('rules') ?? 'nullable';
            $fieldType = $fieldCollection->get('type');
            if ($fieldType == 'select' && $fieldCollection->get('multiple')) $field = $field . '.*';
            if ($fieldType == 'file') {
                // livewire native file upload
                $this->customValidateFilesIn($field, $fieldRule);
            } else {
                $this->validateOnly($field, $this->get_rules());
            }
        }
    }

}
