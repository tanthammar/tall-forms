<?php


namespace Tanthammar\TallForms\Traits;


trait ValidatesFields
{

    public function validationRules()
    {
        return $this->validationRulesRecursively($this->fields());
    }

    /**
     *
     * @param array $fields
     * @param string $prefix
     * @return array
     */
    protected function validationRulesRecursively(array $fields, string $prefix = 'form_data'): array
    {
        $rules = [];

        foreach ($fields as $field) {
            if (filled($field)) {
                if (in_array($field->type, ['array', 'keyval'])) {
                    if (property_exists($field, 'fields') && is_array($field->fields) && 0 < count($field->fields)) {
                        $ruleName = $field->type === 'array' ? "{$prefix}.{$field->name}.*" : "{$prefix}.{$field->name}";
                        $rules = array_merge($rules, $this->validationRulesRecursively($field->fields, $ruleName));
                    }
                    $rules["$prefix.$field->name"] = $field->rules ?? 'nullable';

                } else {
                    if ($field->type === 'file') {
                        $ruleName = $field->multiple ? "{$field->name}.*" : $field->name;
                    }
                    elseif ($field->type === 'select') {
                        $ruleName = "{$prefix}.{$field->name}.*";
                    } else {
                        $ruleName = "{$prefix}.{$field->name}";
                    }

                    $rules[$ruleName] = $field->rules ?? 'nullable';
                }
            }
        }
        return $rules;
    }

    protected function validationAttributes()
    {
        $attributes = [];
        if ($this->labelsAsAttributes) {
            foreach ($this->getFields() as $field) {
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
                $this->validateOnly($field,
                    [$field => $fieldRule],
                    [],
                    $this->validationAttributes
                );
            }
        }
    }

}
