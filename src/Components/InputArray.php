<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\InputArray as Field;
use Tanthammar\TallForms\Traits\Helpers;

class InputArray extends Component
{
    public Field $field;

    public function __construct(Field $field)
    {
        $this->field = $field;
    }

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
            'type' => $this->field->input_type,
            'class' => $this->class()
        ];
        return array_merge($default, $custom);
    }

    public function class()
    {
        $class = "form-input my-1 w-full "; //example class from a default input field
        $class .= $this->field->class;
        return Helpers::unique_words($class);
    }

    public function error()//example class from a default input field
    {
        return Helpers::unique_words($this->class()." border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red");
    }

    public function render(): View
    {
        return view('tall-forms::components.input-array');
    }
}
