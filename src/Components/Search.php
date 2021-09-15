<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;
use Tanthammar\TallForms\Traits\Helpers;

class Search extends BaseBladeField
{
    use Helpers;

    public function __construct(
        public array|object $field = [],
        public array        $attr = []
    )
    {
        parent::__construct((array)$field, $attr);
        $this->attr = array_merge($this->inputAttributes(), $attr);
    }

    public function defaults(): array
    {
        return [
            'id' => 'search',
            'searchKey' => 'searchKey',
            'debounce' => '500',
            'listWidth' => 'tf-search-dropdown-width',
            'placeholder' => __('tf::form.search.placeholder'),
            'class' => 'form-input w-full shadow-inner my-1',
            'wrapperClass' => 'w-full',
            'options' => [],
            'disabled' => false,
        ];
    }

    public function inputAttributes(): array
    {
        return [
            'id' => $this->field->id,
            'name' => $this->field->name,
            'value' => old($this->field->name),
            'type' => 'text',
            'placeholder' => $this->field->placeholder,
        ];
    }


    public function render(): View
    {
        return view('tall-forms::components.search');
    }
}
