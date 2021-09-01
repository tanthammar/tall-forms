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
            'class' => 'form-input my-1 w-full shadow px-0 divide-y',
            'wrapperClass' => null,
            'options' => [],
        ];
    }

    public function render(): View
    {
        return view('tall-forms::components.multiselect');
    }
}
