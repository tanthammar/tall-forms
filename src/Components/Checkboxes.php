<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;

class Checkboxes extends BaseBladeField
{
    public function __construct(
        public array|object $field = [],
        public array        $attr = [],
    )
    {
        parent::__construct((array)$field, $attr);
    }

    public function defaults(): array
    {
        return [
            'id' => 'checkboxes',
            'class' => "form-checkbox tf-checkbox",
            'wrapperClass' => "tf-checkboxes-fieldset",
            'checkboxLabelClass' => "tf-checkbox-label",
            'labelWrapperClass' => "tf-checkbox-label-spacing",
            'options' => [],
            'disabled' => false,
        ];
    }

    public function render(): View
    {
        return view('tall-forms::components.checkboxes');
    }
}
