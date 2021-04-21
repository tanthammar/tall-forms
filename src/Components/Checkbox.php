<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Checkbox as Field;

class Checkbox extends Component
{

    public function __construct(
        public Field $field,
        public string $label = "")
    {
        $this->label = $field->placeholder ?? $field->label;
    }

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
//            $this->field->wire => $this->field->key,
            'x-model' => 'checkbox',
            'name' => $this->field->key,
            'id' => \Str::slug($this->field->key),
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
