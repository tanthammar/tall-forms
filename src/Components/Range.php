<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Traits\BaseBladeField;

class Range extends Component
{
    public function __construct(
        public array|object $field = [],
        public array $attr = [])
    {
        $this->field = BaseBladeField::setDefaults($this->defaults(), $field);
    }

    protected function defaults(): array
    {
        return [
            'id' => 'range',
            'step' => 1,
            'min' => 1,
            'max' => 100,
            'class' => 'flex-1 w-full',
            'wrapperClass' => 'w-full'
        ];
    }

    public function render(): View
    {
        return view('tall-forms::components.range');
    }
}
