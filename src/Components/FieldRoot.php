<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Traits\Helpers;

class FieldRoot extends Component
{
    use Helpers;

    public bool $inArray;
    public int $colspan;
    public array $attr;

    public function __construct(bool $inArray, int $colspan = 12, array $attr = [])
    {
        $this->inArray = $inArray; // if this field is inside a Keyval or Repeater
        $this->colspan = $colspan;
        $this->attr = $attr;
        $this->class();
    }

    public function class(): void
    {
        $vertical_space = $this->inArray ? ' tf-fields-root-py-inarray ' : ' tf-fields-root-py-not-inarray '; //vertical space
        $colspan = config('tall-forms.col-span-classes')[$this->colspan];
        $class = data_get($this->attr, 'class', 'tf-fields-root');
        data_set($this->attr, 'class', Helpers::unique_words($class . $vertical_space . $colspan));
    }

    public function render(): View
    {
        return view('tall-forms::components.field-root');
    }
}
