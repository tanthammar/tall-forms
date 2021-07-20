<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class Checkboxes extends Component
{
    public function __construct(
        public string $id,
        public array $options = [],
        public ?string $name = "",
        public ?string $wrapperClass = "tf-checkboxes-fieldset",
        public ?string $labelClass = "tf-checkbox-label",
        public ?string $labelWrapperClass = "tf-checkbox-label-spacing",
        public ?string $class = "form-checkbox tf-checkbox",
        public ?array $attr = [],
    ){
        $this->name = $this->name ?: $this->id;
    }

    public function render(): View
    {
        return view('tall-forms::components.checkboxes');
    }
}
