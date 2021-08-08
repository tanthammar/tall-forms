<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;

class Checkboxes extends BaseBladeField
{
    public function __construct(
        public array|object $field = [],
        public array $options = [],
        public ?array $attr = [],
    ){
        parent::__construct($field);
    }

    public function defaults(): array
    {
        return [
            'id' => 'checkboxes',
            'wrapperClass' => "tf-checkboxes-fieldset",
            'labelWrapperClass' => "tf-checkbox-label-spacing",
            'labelClass' => "tf-checkbox-label",
            'class' => "form-checkbox tf-checkbox",
        ];
    }

    public function render(): View
    {
        return view('tall-forms::components.checkboxes');
    }
}
