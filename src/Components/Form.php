<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Input as Field;

class Form extends Component
{
    public array $attr;
    public string $onKeyDownEnter;

    public function __construct(string $onKeyDownEnter = '', array $attr = [])
    {
        $this->attr = $attr;
        $this->onKeyDownEnter = $onKeyDownEnter;
    }

    public function class(): string
    {
        return data_get($this->attr, 'class', config('tall-forms.component-attributes.form.class'));
    }

    public function render(): View
    {
        return view('tall-forms::components.form');
    }
}
