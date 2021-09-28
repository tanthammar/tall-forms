<?php


namespace Tanthammar\TallForms\Traits;


trait ValidatesFields
{

    /**
     *
     * @param array|string|null $fields
     * @param string $prefix
     * @return array
     */
    protected function get_rules($fields = null, string $prefix = 'form_data'): array
    {
        $fields = is_null($fields) || !is_array($fields) ? $this->fields() : $fields;
        $rules = [];

        foreach ($fields as $field) {
            if (filled($field)) {
                if (in_array($field->type, ['array', 'keyval']) || $field->ignored) {
                    if (isset($field->fields) && filled($field->fields)) {
                        $ruleName = $field->type === 'array'
                            ? "$prefix.$field->name.*"
                            : ($field->ignored ? $prefix : "$prefix.$field->name");
                        //recursive
                        $rules = array_merge($rules, $this->get_rules($field->fields, $ruleName));
                    }
                    $rules["$prefix.$field->name"] = $field->rules ?? 'nullable';

                } else {
                    if ($field->type === 'file') {
                        $ruleName = $field->multiple ? "$field->name.*" : $field->name;
                    }
                    elseif (in_array($field->type, ['input-array', 'tags'])) {
                        $ruleName = "$prefix.$field->name.*";
                    } else {
                        $ruleName = "$prefix.$field->name";
                    }

                    $rules[$ruleName] = $field->rules ?? 'nullable';
                }
            }
        }
        //Merge with Livewire default $rules || rules() takes precedence
        return array_merge($rules, $this->getRules());
    }

    protected function validationAttributes(): array
    {
        $attributes = [];
        if ($this->form->labelsAsAttributes) {
            foreach ($this->getFieldsFlat() as $field) {
                if ($field != null && !$field->ignored && $field->labelAsAttribute) {
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

    public function updated($field, $value): void
    {
        //updatedFoo
        $function = $this->parseFunctionNameFrom($field); //studly field->key minus form_data
        $fieldIndexKey = $this->getKeyIndexFrom($field); //first found index integer
        if (method_exists($this, $function)) $this->$function($value, $fieldIndexKey);

        //updatedFooValidate
        $function = $function . 'Validate';
        if (method_exists($this, $function)) {
            $this->$function($value, $fieldIndexKey);
            return;
        }

        //realtime validation
        $fieldCollection = $this->collectField($field);
        if (filled($fieldCollection)) {
            $fieldRule = $fieldCollection->get('rules') ?? 'nullable';
            $fieldType = $fieldCollection->get('type');
            if (in_array($fieldType, ['input-array', 'tags'])) $field = $field . '.*';
            if ($fieldType == 'file') {
                // livewire native file upload
                $this->customValidateFilesIn($field, $fieldRule);
            } else {
                $this->validateOnly(field: $field, rules: $this->get_rules());
            }
        }
    }

}
