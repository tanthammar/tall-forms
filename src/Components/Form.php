<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public array $attr;
    public ?string $onKeyDownEnter;

    public function __construct(?string $onKeyDownEnter = null, array $attr = [])
    {
        $this->attr = $attr;
        $this->onKeyDownEnter = $onKeyDownEnter;
    }

    public function class(): string
    {
        return data_get($this->attr, 'class', 'tf-form');
    }

    public function render(): View
    {
        return view('tall-forms::components.form');
    }
}
