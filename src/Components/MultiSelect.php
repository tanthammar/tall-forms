<?php

namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;

class MultiSelect extends Select
{

    public function defaults(): array
    {
        return [
            'id' => 'multiselect',
            'placeholder' => __('tf::form.multiselect.placeholder'),
            'defer' => true,
            'multiple' => true,
            'class' => 'form-multiselect',
            'wrapperClass' => null,
            'options' => [],
            'disabled' => false,
        ];
    }

    //override Select because multiselect is entangled
    public function inputAttributes(): array
    {
        return [
            //$this->field->wire => $this->field->key, //entangled
            'id' => $this->field->id,
            'name' => $this->field->name,
            'value' => old($this->field->name)
        ];
    }

    public function render(): View
    {
        return view('tall-forms::components.multiselect');
    }
}
