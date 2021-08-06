<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Traits\BaseBladeField;
use Tanthammar\TallForms\Traits\Helpers;

class Radio extends Component
{
    public function __construct(
        public array|object $field = [],
        public array $options = [],
        public array $attr = [],
    )
    {
        $this->field = BaseBladeField::setDefaults($this->defaults(), $field);
    }

    protected function defaults(): array
    {
        return [
            'id' => 'radio', //unique, concats id.value.loop-index on each radio input,
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
