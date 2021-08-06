<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Traits\BaseBladeField;

class Checkboxes extends Component
{
    public function __construct(
        public array|object $field = [],
        public array $options = [],
        public ?array $attr = [],
    ){
        $this->field = BaseBladeField::setDefaults($this->defaults(), $field);
    }

    protected function defaults(): array
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
