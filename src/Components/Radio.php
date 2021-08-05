<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Traits\Helpers;

class Radio extends Component
{
    public function __construct(
        public array|object $field,
        public array $options = [],
        public array $attr = [],
    )
    {
        $this->field = Helpers::mergeFilledToObject($this->defaults(), $field);
        $this->field->key = $this->field->key ?: $this->field->id;
        $this->field->name = $this->field->name ?: $this->field->id;
    }

    public function defaults()
    {
        return [
            'id' => 'radio', //unique, concats id.value.loop-index on each radio input,
            'key' => null, //Livewire prop, input radio name, falls back to id
            'name' => null, //input name, falls back to 'id'
            'radioClass' => "form-radio tf-radio",
            'radioLabelClass' => "tf-radio-label",
            'spacing' => "tf-radio-label-spacing",
            'class' => 'flex', //div wrapping input & label
            'wrapperClass' => false, //outmost div, string
        ];
    }

    public function render(): View
    {
        return view('tall-forms::components.radio');
    }
}
