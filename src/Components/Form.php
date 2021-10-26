<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public function __construct(
        public string $onKeyDownEnter = 'saveAndStay',
        public array  $attr = []
    ){}

    public function render(): View
    {
        return view('tall-forms::components.form');
    }
}
