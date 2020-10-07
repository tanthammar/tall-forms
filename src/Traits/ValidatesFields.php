<?php


namespace Tanthammar\TallForms\Traits;


trait ValidatesFields
{

    public function get_rules()
    {
        $rules = [];
        foreach ($this->fields() as $field) {
            if ($field != null) {

                if (!in_array($field->type, ['array', 'keyval', 'file'])) $rules[$field->key] = $field->rules ?? 'nullable';

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
                if ($field->type === 'multiselect') $rules["$field->key.*"] = $field->rules ?? 'nullable';
            }
        }
        return $rules;
    }

    public function validationAttributes() {
        $attributes = [];
        if($this->labelsAsAttributes) {
            foreach ($this->fields() as $field) {
                if ($field != null) {
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

        if ($this->getFieldValueByKey($field, 'realtimeValidationOn')) {
            $fieldType = $this->getFieldType($field);
            if ($fieldType == 'file') {
                // livewire native file upload
                $this->customValidateFilesIn($field, $this->getFieldValueByKey($field, 'rules'));//this does not work for array keyval fields
            } else {
                $this->validateOnly($field,
                    [$field => $this->getFieldValueByKey($field, 'rules')],
                    [],
                    $this->validationAttributes
                );
            }
        }
    }

}
