<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;

class Checkbox extends BaseBladeField
{
    public string $label;

    public function __construct(
        public array|object $field = [],
        public array       $attr = [],
    )
    {
        parent::__construct((array)$field, $attr);
        $this->attr = array_merge($this->inputAttributes(), $attr);
        $this->label = $this->field->placeholder ?? $this->field->label ?? '';
    }

    protected function defaults(): array
    {
        return [
            'id' => 'checkbox',
            'class' => 'form-checkbox tf-checkbox',
            'wrapperClass' => 'flex',
            'checkboxLabelClass' => 'tf-checkbox-label',
            'labelWrapperClass' => 'tf-checkbox-label-spacing',
            'disabled' => false,
        ];
    }

    protected function inputAttributes(): array
    {
        $custom = data_get($this->field, 'attributes.input', []);
        $default = [
            $this->field->wire => $this->field->key,
            'name' => $this->field->name,
            'id' => $this->field->id,
            'value' => old($this->field->name),
            'wire:key' => $this->field->id,
        ];
        return array_merge($default, $custom);
    }

    public function render(): View
    {
        return view('tall-forms::components.checkbox');
    }

}
