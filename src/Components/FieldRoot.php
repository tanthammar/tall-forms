<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Helpers;

class FieldRoot extends Component
{
    public function __construct(
        public bool $inArray, // if this field is inside a Keyval or Repeater
        public int $colspan = 12,
        public array $attr = [])
    {
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
