<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Checkbox as Field;

class Checkbox extends Component
{
    public Field $field;
    public string $label;

    public function __construct(Field $field)
    {
        $this->field = $field;
        $this->label = $field->placeholder ?? $field->label;
    }

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
            $this->field->wire => $this->field->key,
            'name' => $this->field->key,
            'class' => $this->class()
        ];
        return array_merge($default, $custom);
    }

    public function class(): string
    {
        return "form-checkbox tf-checkbox";
    }


    public function render(): View
    {
        return view('tall-forms::components.checkbox');
    }
}
