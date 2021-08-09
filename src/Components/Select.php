<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;
use Tanthammar\TallForms\Traits\Helpers;

class Select extends BaseBladeField
{
    use Helpers;

    public function __construct(
        public array|object      $field = [],
        public array             $options = [],
        public array             $attr = []
    )
    {
        parent::__construct($field);
        $this->attr = array_merge($this->inputAttributes(), $attr);
    }

    public function defaults(): array
    {
        return [
            'id' => 'select',
            'placeholder' => __('tf::form.select.placeholder'),
            'defer' => false, //doesn't use entangle
            'multiple' => false,
            'class' => 'form-select my-1 w-full shadow',
        ];
    }

    public function inputAttributes(): array
    {
        return [
            'id' => $this->field->id,
            'name' => $this->field->name,
            'value' => old($this->field->name)
        ];
    }


    public function render(): View
    {
        return view('tall-forms::components.select');
    }
}
