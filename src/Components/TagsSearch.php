<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;

class TagsSearch extends BaseBladeField
{
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
            'id' => 'tagssearch',
            'searchKey' => 'searchKey',
            'debounce' => '500',
            'listWidth' => 'tf-search-dropdown-width',
            'placeholder' => __('tf::form.tags-search.placeholder'),
            'class' => 'form-textarea block w-full rounded shadow-inner my-1',
            'wrapperClass' => 'tf-tags-wrapper',
            'options' => [],
            'disabled' => false,
            'required' => false,
            'defer' => true,
            'allowNew' => true,
        ];
    }

    public function inputAttributes(): array
    {
        return [
            $this->field->wire => $this->field->key,
            'id' => $this->field->id,
            'name' => $this->field->name,
            'placeholder' => $this->field->placeholder,
        ];
    }

    public function render(): View
    {
        return view('tall-forms::components.tags-search');
    }
}
