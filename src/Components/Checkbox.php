<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public function __construct(
        public string $id,
        public ?string $name = null,
        public ?string $label = "",
        public ?string $wrapperClass = "flex",
        public ?string $labelClass = "tf-checkbox-label",
        public ?string $labelWrapperClass = "tf-checkbox-label-spacing",
        public ?string $class = "form-checkbox tf-checkbox",
        public ?array $attr = [],
    ){
        $this->name = $this->name ?: $this->id;
    }

    public function render()
    {
        return view('tall-forms::components.checkbox');
    }

}
