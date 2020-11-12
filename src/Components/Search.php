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
    public array $options;
    public string $listWidth;

    public function __construct(Field $field, array $options = [])
    {
        $this->field = $field;
        $this->options = $options;
        $this->listWidth = $field->listWidth ?? 'tf-search-dropdown-width';
    }

    public function class(): string
    {
        $class = "form-input w-full shadow-inner my-1 ";
        $class .= $this->field->class;
        return Helpers::unique_words($class);
    }

    public function error(): string
    {
        return $this->class()." tf-field-error";
    }

    public function render(): View
    {
        return view('tall-forms::components.search');
    }
}
