<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Search as Field;
use Tanthammar\TallForms\Traits\Helpers;

class Search extends Component
{
    use Helpers;

    public Field $field;
    public string $temp_key;
    public array $options;
    public string $label_array_class;
    public string $listWidth;

    public function __construct(Field $field, string $tempKey, array $options = [])
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
        $this->options = $options;
        $this->label_array_class = $field->inlineLabel ? 'flex space-x-2 items-baseline' : 'flex flex-col';
        $this->listWidth = $field->listWidth ?? 'max-w-xs w-full';
    }

    public function class(): string
    {
        $class = "form-input w-full ";
        $class .= $this->field->class;
        return Helpers::unique_words($class);
    }

    public function error(): string
    {
        return Helpers::unique_words($this->class()." border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red");
    }

    public function render(): View
    {
        return view('tall-forms::components.search');
    }
}
