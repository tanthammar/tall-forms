<?php

namespace Tanthammar\TallForms\Traits;

use Illuminate\Support\Arr;

trait HandlesArrays
{
    protected function arrayFlipOrCombine(array $options): void
    {
        $this->options = Arr::isAssoc($options) ? array_flip($options) : array_combine($options, $options);
    }

    public function arrayAdd($field_name_or_key_without_form_data)
    {
        $array_fields = [];

        $field = collect($this->getFieldsFlat())->firstWhere('key', 'form_data.' . $field_name_or_key_without_form_data);

        if (filled($field)) {
            foreach ($field->fields as $array_field) {
                $array_fields[$array_field->name] = $array_field->default ?? ($array_field->type == 'checkboxes' ? [] : null);
            }
        }

        $repeater_form_data = data_get($this->form_data, $field_name_or_key_without_form_data);
        $repeater_form_data = is_array($repeater_form_data) ? $repeater_form_data : [];
        array_push($repeater_form_data, $array_fields);

        data_set($this->form_data, $field_name_or_key_without_form_data, $repeater_form_data);

        $this->updated('form_data.' . $field_name_or_key_without_form_data, data_get($this->form_data, $field_name_or_key_without_form_data));
    }

    public function arrayMoveUp($field_name_or_key_without_form_data, $key)
    {
        if ($key > 0) {
            $field = data_get($this->form_data, $field_name_or_key_without_form_data);
            $prev = data_get($field, $key-1);
            data_set($field, $key-1, data_get($field, $key));
            data_set($field, $key, $prev);
            data_set($this->form_data, $field_name_or_key_without_form_data, $field);
        }
    }

    public function arrayMoveDown($field_name_or_key_without_form_data, $key)
    {
        if (($key + 1) < count($this->form_data[$field_name_or_key_without_form_data])) {
            $field = data_get($this->form_data, $field_name_or_key_without_form_data);
            $next = data_get($field, $key+1);
            data_set($field, $key+1, data_get($field, $key));
            data_set($field, $key, $next);
            data_set($this->form_data, $field_name_or_key_without_form_data, $field);
        }
    }

    //also used by File input
    public function arrayRemove($field_name_or_key_without_form_data, $key, $is_in_form_data = true)
    {
        if ($is_in_form_data) {
            Arr::forget($this->form_data, "{$field_name_or_key_without_form_data}.{$key}");
            //data_set($this->form_data, $field_name_or_key_without_form_data, array_values(data_get($this->form_data, $field_name_or_key_without_form_data)));
        } else {
            unset($this->$field_name_or_key_without_form_data[$key]);
            $this->$field_name_or_key_without_form_data = array_values($this->$field_name_or_key_without_form_data);
        }
    }

    public function autoSelectSingleArrayValue(string $arrayName, string $field)
    {
        if (count($this->$arrayName) === 1) {
            $this->form_data[$field] = array_values($this->$arrayName);
        }
    }
}
