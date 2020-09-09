<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Input as Field;

class Input extends Component
{
    public Field $field;
    public string $temp_key;

    public function __construct(Field $field, string $tempKey)
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
    }

    public function options(): array
    {
        $default = [
            $this->field->wire => $this->temp_key,
            'field' => $this->temp_key,
            'name' => $this->temp_key,
            'type' => $this->field->input_type,
            'autocomplete' => $this->field->autocomplete,
            'placeholder' => $this->field->placeholder,
        ];
        if (in_array($this->field->type, ['number', 'range', 'date', 'datetime-local', 'month', 'time', 'week'])) {
            $limits = [
                'min' => $this->field->min,
                'max' => $this->field->max,
                'step' => $this->field->step,
            ];
            $default = array_merge($default, $limits);
        }
        return array_merge($default);
    }

    public function class()
    {
        $class = "flex-1 bg-yellow-200 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5";
        $class .= ($this->field->prefix || $this->field->icon) ? " rounded-none rounded-r-md" : " rounded";
        return $class;
    }

    public function error()
    {
        return $this->class()." border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red";
    }

    public function render(): View
    {
        return view('tall-forms::components.input');
    }
}
