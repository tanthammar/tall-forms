<?php

namespace Tanthammar\TallForms\Traits;

use Illuminate\Support\Arr;

trait HandlesArrays
{
    protected function arrayFlipOrCombine(array $options): void
    {
        $this->options = Arr::isAssoc($options) ? array_flip($options) : array_combine($options, $options);
    }

    public function arrayAdd(string $field_key): void
    {
        $array = data_get($this, $field_key, []);
        if(is_array($array)) {
            $array[] = [];
            data_set($this, $field_key, $array);
            $this->updated($field_key, data_get($this, $field_key));
        }
    }

    public function arrayMoveUp(string $field_key, int|string $key): void
    {
        if ($key > 0) {
            $field = data_get($this, $field_key);
            if(filled($field)) {
                $prev = data_get($field, $key-1);
                data_set($field, $key-1, data_get($field, $key));
                data_set($field, $key, $prev);
                data_set($this, $field_key, $field);
                $this->validate();
            }
        }
    }

    public function arrayMoveDown(string $field_key, int|string $key): void
    {
        if (($key + 1) < count(data_get($this, $field_key, []))) {
            $field = data_get($this, $field_key);
            if(filled($field)) {
                $next = data_get($field, $key + 1);
                data_set($field, $key + 1, data_get($field, $key));
                data_set($field, $key, $next);
                data_set($this, $field_key, $field);
                $this->validate();
            }
        }
    }

    //also used by File input
    public function arrayRemove(string $field_key, int|string $key, bool $is_in_form_data = true): void
    {
        $array = (array)$this;
        Arr::forget($array, "{$field_key}.{$key}");
        data_set($this, $field_key, array_values(data_get($array, $field_key)));
        $this->validate();
        $this->updated($field_key, data_get($array, $field_key));
    }

    /**
     * Helper for belongsTo selects, to auto-select the first value if only one
     * @param string $arrayName
     * @param string $field
     */
    protected function autoSelectSingleArrayValue(string $arrayName, string $field): void
    {
        if (count($this->$arrayName) === 1) {
            $this->form_data[$field] = array_values($this->$arrayName);
        }
    }
}
