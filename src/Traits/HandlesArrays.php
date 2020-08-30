<?php

namespace Tanthammar\TallForms\Traits;


trait HandlesArrays
{
    protected function arrayFlipOrCombine(array $options): void
    {
        $this->options = \Arr::isAssoc($options) ? array_flip($options) : array_combine($options, $options);
    }

    public function arrayAdd($field_name)
    {
        $array_fields = [];

        foreach ($this->fields() as $field) {
            if (filled($field)) {
                if ($field->name == $field_name) {
                    foreach ($field->fields as $array_field) {
                        $array_fields[$array_field->name] = $array_field->default ?? ($array_field->type == 'checkboxes' ? [] : null);
                    }

                    break;
                }
            }
        }

        $this->form_data[$field_name][] = $array_fields;
        $this->updated('form_data.' . $field_name, data_get($this->form_data, $field_name));
    }

    public function arrayMoveUp($field_name, $key)
    {
        if ($key > 0) {
            $prev = $this->form_data[$field_name][$key - 1];
            $this->form_data[$field_name][$key - 1] = $this->form_data[$field_name][$key];
            $this->form_data[$field_name][$key] = $prev;
        }
    }

    public function arrayMoveDown($field_name, $key)
    {
        if (($key + 1) < count($this->form_data[$field_name])) {
            $next = $this->form_data[$field_name][$key + 1];
            $this->form_data[$field_name][$key + 1] = $this->form_data[$field_name][$key];
            $this->form_data[$field_name][$key] = $next;
        }
    }

    //also used by File input
    public function arrayRemove($field_name, $key, $is_in_form_data = true)
    {
        if($is_in_form_data) {
            unset($this->form_data[$field_name][$key]);
            $this->form_data[$field_name] = array_values($this->form_data[$field_name]);
        } else {
            unset($this->$field_name[$key]);
            $this->$field_name = array_values($this->$field_name);
        }
    }

    public function autoSelectSingleArrayValue(string $arrayName, string $field)
    {
        if (count($this->$arrayName) === 1) {
            $this->form_data[$field] = array_values($this->$arrayName);
        }
    }
}
