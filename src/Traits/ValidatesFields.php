<?php


namespace Tanthammar\TallForms\Traits;

trait ValidatesFields
{
    protected array $memoizedRules = [];

    //Used by Livewire default getRules():array method where rules() takes precedence before $rules
    protected function rules(): array
    {
        return $this->fieldRules();
    }

    //Used by Livewire default getValidationAttributes():array method where validationAttributes() takes precedence before $validationAttributes
    protected function validationAttributes(): array
    {
        return $this->fieldValidationAttributes();
    }

    // Because Livewire calls rules() multiple times per request, https://github.com/livewire/livewire/discussions/4045
    protected function fieldRules(): array
    {
        if ($this->memoizedRules === []) $this->memoizedRules = $this->recursiveFieldRules();
        return $this->memoizedRules;
    }


    protected function recursiveFieldRules($fields = null, string $prefix = 'form_data'): array
    {
        $fields = is_null($fields) || !is_array($fields) ? $this->getFields() : $fields;
        $rules = [];

        foreach ($fields as $field) {
            if (filled($field)) {
                if (in_array($field->type, ['array', 'keyval']) || $field->ignored) {
                    if (isset($field->fields) && filled($field->fields)) {
                        $ruleName = $field->type === 'array'
                            ? "$prefix.$field->name.*"
                            : ($field->ignored ? $prefix : "$prefix.$field->name");
                        //recursive
                        $rules = array_merge($rules, $this->recursiveFieldRules($field->fields, $ruleName));
                    }
                    $rules["$prefix.$field->name"] = $field->rules ?? 'nullable';

                } else {
                    if ($field->type === 'file') {
                        $ruleName = $field->multiple ? "$field->name.*" : $field->name;
                    }
                    //TODO add $rulesAppliedToEach = true to these field types
                    //These field types applies rules to each item, DON'T add checkboxes or multiselect here. They use Rule::in([...]) validation.
                    elseif (in_array($field->type, ['input-array', 'tags', 'tags-search'])) {
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

    protected function fieldValidationAttributes(): array
    {
        $attributes = [];
        if ($this->getForm()->labelsAsAttributes) {
            foreach ($this->getFieldsFlat() as $field) {
                if ($field != null && !$field->ignored && $field->labelAsAttribute) {
                    if (in_array($field->type, ['array', 'keyval'])) {
                        foreach ($field->fields as $array_field) {
                            $key = $field->type === 'array'
                                ? "$field->key.*.$array_field->name"
                                : "$field->key.$array_field->name";
                            $attributes[$key] = $array_field->validationAttr ?? $array_field->label;
                        }
                    } elseif (in_array($field->type, ['input-array', 'tags', 'tags-search'])) {
                        $attributes[$field->key.'.*'] = $field->validationAttr ?? $field->label;
                    } else {
                        $attributes[$field->key] = $field->validationAttr ?? $field->label;
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
            if (in_array($fieldType, ['input-array', 'tags', 'tags-search'])) $field = $field . '.*';
            if ($fieldType == 'file') {
                // requires trait UploadsFiles
                $this->customValidateFilesIn($field, $fieldRule);
            } else {
                $this->validateOnly(field: $field);
            }
        }
    }

}
