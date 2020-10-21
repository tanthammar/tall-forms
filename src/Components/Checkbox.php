<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Checkbox as Field;

class Checkbox extends Component
{
    public Field $field;
    public string $temp_key;
    public string $label;

    public function __construct(Field $field, string $tempKey)
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
        $this->label = $field->placeholder ?? $field->label;
    }

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
            $this->field->wire => $this->temp_key,
            'name' => $this->temp_key,
            'class' => $this->class()
        ];
        return array_merge($default, $custom);
    }

    public function class(): string
    {
        return "form-checkbox tall-forms-checkbox";
    }


    public function render(): View
    {
        return view('tall-forms::components.checkbox');
    }
}
