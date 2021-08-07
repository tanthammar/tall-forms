<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Traits\BaseBladeField;
use Tanthammar\TallForms\Traits\Helpers;

class Search extends Component
{
    use Helpers;

    public function __construct(
        public array|object $field = [],
        public array        $options = [],
        public array        $attr = []
    )
    {
        $this->field = BaseBladeField::setDefaults($this->defaults(), $field);
        $this->field->class = $this->class($field);
    }

    protected function defaults(): array
    {
        return [
            'id' => 'search',
            'searchKey' => 'searchKey',
            'debounce' => '500',
            'listWidth' => 'tf-search-dropdown-width',
            'placeholder' => __('tf::form.search.placeholder'),
            'class' => 'form-input w-full shadow-inner my-1',
            'errorClass' => 'tf-field-error',
            'wrapperClass' => 'w-full',
        ];
    }

    public function class(array $field): string
    {
        if (array_key_exists('class', $field)) {
            $class = $this->field->class;
            $class .= " ";
            $class .= $field['class'];
            return Helpers::unique_words($class);
        }
        return $this->field->class;
    }

    public function error(): string
    {
        return $this->field->class.' '.$this->field->errorClass;
    }

    public function render(): View
    {
        return view('tall-forms::components.search');
    }
}
