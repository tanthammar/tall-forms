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
                        $rules = array_merge($rules, $this->get_rules($field->fields, $ruleName));
                    }
                    $rules["$prefix.$field->name"] = $field->rules ?? 'nullable';

                } else {
                    if ($field->type === 'file') {
                        $ruleName = $field->multiple ? "$field->name.*" : $field->name;
                    }
                    elseif ($field->type === 'multiselect') {
                        $ruleName = "$prefix.$field->name.*";
                    } else {
                        $ruleName = "$prefix.$field->name";
                    }

                    $rules[$ruleName] = $field->rules ?? 'nullable';
                }
            }
        }
        return $rules;
    }

    protected function validationAttributes(): array
    {
        $attributes = [];
        if ($this->labelsAsAttributes) {
            foreach ($this->getFieldsFlat() as $field) {
                if ($field != null && $field->labelAsAttribute && !$field->ignored) {
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
        $function = $this->parseFunctionNameFrom($field);
        if (method_exists($this, $function)) $this->$function($value);

        if (filled($fieldCollection = $this->collectField($field)) && $fieldCollection->get('realtimeValidationOn')) {
            $fieldRule = $fieldCollection->get('rules') ?? 'nullable';
            $fieldType = $fieldCollection->get('type');
            if ($fieldType == 'multiselect') $field = $field . '.*';
            if ($fieldType == 'file') {
                // livewire native file upload
                $this->customValidateFilesIn($field, $fieldRule);
            } else {
                $this->validateOnly($field, $this->get_rules());
            }
        }
    }

}
