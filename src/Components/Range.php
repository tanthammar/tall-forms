<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;

class Range extends BaseBladeField
{
    public function __construct(
        public array|object $field = [],
        public array        $attr = [])
    {
        parent::__construct((array)$field, $attr);
        $this->attr = array_merge($this->inputAttributes(), $attr);
    }

    public function defaults(): array
    {
        return [
            'id' => 'range',
            'step' => 1,
            'min' => 1,
            'max' => 100,
            'class' => 'flex-1 w-full',
            'wrapperClass' => 'w-full'
        ];
    }


    public function inputAttributes(): array
    {
        return [
            'type' => 'range',
            'id' => $this->field->id,
            'name' => $this->field->name,
            'value' => old($this->field->name),
            'min' => $this->field->min,
            'max' => $this->field->max,
            'step' => $this->field->step,
        ];
    }

    public function render(): View
    {
        return view('tall-forms::components.range');
    }
}
