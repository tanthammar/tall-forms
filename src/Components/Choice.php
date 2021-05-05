<?php

namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Choice as Field;
use Tanthammar\TallForms\Traits\Helpers;

class Choice extends Component
{
    use Helpers;

    public Field $field;
    public array $value;

    public function __construct(Field $field, array $value = [])
    {
        $this->field = $field;
        $this->value = $value;
        $this->field->placeholder = $this->field->placeholder ?? $this->placeholder();
    }

    public function placeholder()
    {
        return trans(config('tall-forms.choice-placeholder'));
    }

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
            $this->field->wire => $this->field->key,
            'name' => $this->field->key
        ];

        return array_merge($default, $custom);
    }

    public function class(): string
    {
        $class = ($this->field->multiple) ? "form-input my-1 w-full shadow px-0 divide-y " : "form-select my-1 w-full shadow ";
        $class .= $this->field->class;

        return Helpers::unique_words($class);
    }

    public function error(): string
    {
        return $this->class() . " tf-field-error";
    }

    public function render(): View
    {
        return view('tall-forms::components.choice');
    }
}
