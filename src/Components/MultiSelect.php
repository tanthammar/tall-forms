<?php

namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;

class MultiSelect extends Select
{

    protected function defaults(): array
    {
        return [
            'id' => 'multiselect',
            'placeholder' => __('tf::form.multiselect.placeholder'),
            'multiple' => true,
            'class' => 'form-multiselect',
            'wrapperClass' => null,
            'options' => [],
            'disabled' => false,
        ];
    }

    //override Select because multiselect is entangled
    protected function inputAttributes(): array
    {
        $custom = data_get($this->field, 'attributes.input', []);
        $default = [
            //$this->field->wire => $this->field->key, //entangled
            'id' => $this->field->id,
            'name' => $this->field->name,
            'value' => old($this->field->name)
        ];
        return array_merge($default, $custom);
    }

    public function render(): View
    {
        return view('tall-forms::components.multiselect');
    }
}
