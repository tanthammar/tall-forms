<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{

    public function __construct(
        public string $wireModel,
        public string $wrapperClass = "",
        public null|string $deferEntangle = null,
        public string $label = "",
        public array $attr = [],
    ){}

    public function options(): array
    {
        $default = [
            'x-model' => 'checkbox', // $this->field->wire => $this->field->key,
            'name' => \Str::slug($this->wireModel),
            'id' => \Str::slug($this->wireModel)
        ];
        return array_merge($default, $this->attr);
    }

    public function class(): string
    {
        return "form-checkbox tf-checkbox";
    }

    public function render(): View
    {
        return view('tall-forms::components.checkbox');
    }
}
