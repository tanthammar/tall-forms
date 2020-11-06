<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class Svg extends Component
{
    public string $path;
    public ?string $class;

    public function __construct(string $path, ?string $class = null)
    {
        $this->path = $path;
        $this->class = 'svg-icon '.$class;
    }

    public function render(): View
    {
        return view("tall-forms::{$this->path}");
    }
}
