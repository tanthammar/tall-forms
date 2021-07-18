<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\Support\Str;
use Illuminate\View\View;

class Checkbox extends BaseBladeComponent
{
    public function __construct(
        $id,
        $label = "",
        $wrapperClass = "",
        $labelClass = "tf-checkbox-label",
        $class = "form-checkbox tf-checkbox",
        $attr = [],
    )
    {
        parent::__construct(
            id: $id,
            label: $label,
            wrapperClass: $wrapperClass,
            labelClass: $labelClass,
            class: $class,
            attr: $attr
        );

        $this->view = 'tall-forms::components.checkbox';
    }

    public function render()
    {
        return view('tall-forms::components.checkbox');
    }

}
