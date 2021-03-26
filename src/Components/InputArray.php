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
            'placeholder' => $this->field->placeholder,
            'class' => $this->class()
        ];
        return array_merge($default, $custom);
    }

    public function class(): string
    {
        $class = "form-input my-1 w-full "; //example class from a default input field
        $class .= $this->field->class;
        return Helpers::unique_words($class);
    }

    public function error(): string //applied to the outer div surrounding the inputs
    {
        return "border rounded border-red-500 p-2 md:p-4 mb-2";
    }

    public function render(): View
    {
        return view('tall-forms::components.input-array');
    }
}
