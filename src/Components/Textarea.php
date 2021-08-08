<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;

class Textarea extends BaseBladeField
{
    public function __construct(
        public array|object $field = [],
        public array        $attr = []
    )
    {
        parent::__construct($field);
        $this->attr = array_merge($this->inputAttributes(), $attr);
    }

    public function defaults(): array
    {
        return [
            'id' => 'textarea',
            'required' => false,
            'defer' => false, //doesn't use entangle
            'class' => 'form-textarea block w-full rounded shadow-inner my-1',
            'placeholder' => '',
            'rows' => 5,
        ];
    }

    public function inputAttributes(): array
    {
        return [
            'id' => $this->field->id,
            'name' => $this->field->name,
            'placeholder' => $this->field->placeholder,
            'rows' => $this->field->rows,
            'value' => old($this->field->name)
        ];
    }

    public function render(): View
    {
        return view('tall-forms::components.textarea');
    }
}
