<?php

namespace Tanthammar\TallForms\Traits;

use Illuminate\Support\Arr;

trait HandlesArrays
{
    protected function arrayFlipOrCombine(array $options): void
    {
        $this->options = Arr::isAssoc($options) ? array_flip($options) : array_combine($options, $options);
    }

    public function arrayAdd(string $field_name)
    {
        $array_fields = [];

        $field = collect($this->getFieldsFlat())->firstWhere('key', 'form_data.' . $field_name);

        if (filled($field)) {
            foreach ($field->fields as $array_field) {
                $array_fields[$array_field->name] = $array_field->default ?? ($array_field->type == 'checkboxes' ? [] : null);
            }
        } else {
            return;
        }

        $repeater_form_data = data_get($this->form_data, $field_name);
        $repeater_form_data = is_array($repeater_form_data) ? $repeater_form_data : [];
        array_push($repeater_form_data, $array_fields);

        data_set($this->form_data, $field_name, $repeater_form_data);

        $this->updated('form_data.' . $field_name, data_get($this->form_data, $field_name));
    }

    public function arrayMoveUp(string $field_name, int|string $key)
    {
        if ($key > 0) {
            $field = data_get($this->form_data, $field_name);
            if(filled($field)) {
                $prev = data_get($field, $key-1);
                data_set($field, $key-1, data_get($field, $key));
                data_set($field, $key, $prev);
                data_set($this->form_data, $field_name, $field);
            }
        }
    }

    public function arrayMoveDown(string $field_name, int|string $key)
    {
        if (($key + 1) < count($this->form_data[$field_name])) {
            $field = data_get($this->form_data, $field_name);
            if(filled($field)) {
                $next = data_get($field, $key + 1);
                data_set($field, $key + 1, data_get($field, $key));
                data_set($field, $key, $next);
                data_set($this->form_data, $field_name, $field);
            }
        }
    }

    //also used by File input
    public function arrayRemove(string $field_name, int|string $key, bool $is_in_form_data = true)
    {
        if ($is_in_form_data) {
            Arr::forget($this->form_data, "{$field_name}.{$key}");
            data_set($this->form_data, $field_name, array_values(data_get($this->form_data, $field_name)));
        } else {
            unset($this->$field_name[$key]);
            $this->$field_name = array_values($this->$field_name);
        }
    }

    /**
     * Helper for belongsTo selects, to auto-select the first value if only one
     * @param string $arrayName
     * @param string $field
     */
    protected function autoSelectSingleArrayValue(string $arrayName, string $field)
    {
        if (count($this->$arrayName) === 1) {
            $this->form_data[$field] = array_values($this->$arrayName);
        }
    }
}
