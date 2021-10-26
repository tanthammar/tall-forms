<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;

class Search extends BaseBladeField
{
    public function __construct(
        public array|object $field = [],
        public array        $attr = []
    )
    {
        parent::__construct((array)$field, $attr);
        $this->attr = array_merge($this->inputAttributes(), $attr);
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
            'wrapperClass' => 'w-full',
            'options' => [],
            'disabled' => false,
        ];
    }

    protected function inputAttributes(): array
    {
        $custom = data_get($this->field, 'attributes.input', []);
        $default = [
            'id' => $this->field->id,
            'name' => $this->field->name,
            'value' => old($this->field->name),
            'type' => 'text',
            'placeholder' => $this->field->placeholder,
        ];
        return array_merge($default, $custom);
    }


    public function render(): View
    {
        return view('tall-forms::components.search');
    }
}
