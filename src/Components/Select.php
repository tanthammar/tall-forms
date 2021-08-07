<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Traits\Helpers;

class Select extends Component
{
    use Helpers;

    public function __construct(
        public array|object $field,
        public null|string|array $value = [],
        public array $options = [],
        public array $attr = [],
    )
    {
        $this->field = Helpers::mergeFilledToObject($this->defaults(), $field);
        $this->field->placeholder = $this->field->placeholder ?: (
            $this->field->multiple
                ? __('tf::form.multiselect.placeholder')
                : __('tf::form.select.placeholder')
        );
        $this->field->name = $this->field->name ?: $this->field->id;
        $this->field->key = $this->field->key ?: $this->field->id;
    }

    public function defaults(): array
    {
        return [
            'id' => 'select',
            'name' => null,
            'key' => null,
            'placeholder' => null, //see construct
            'multiple' => false,
            'class' => '', //see class() + error()
        ];
    }

    public function class(): string
    {
        $class = $this->field->multiple ? "form-input my-1 w-full shadow px-0 divide-y " : "form-select my-1 w-full shadow";
        if(filled($this->field->class)) {
            $class .= " ";
            $class .= $this->field->class;
            return Helpers::unique_words($class);
        } else {
            return $class;
        }
    }

    public function error(): string
    {
        return $this->class() . " tf-field-error";
    }

    public function render(): View
    {
        return ($this->field->multiple) ? view('tall-forms::components.multiselect') : view('tall-forms::components.select');
    }
}
