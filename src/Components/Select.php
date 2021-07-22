<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Select as Field;
use Tanthammar\TallForms\Traits\Helpers;

class Select extends Component
{
    use Helpers;

    public Field $field;
    public array $value;

    public function __construct(Field $field, array $value = [])
    {
        $this->field = $field;
        $this->value = $value;
        $this->field->help = $this->field->help ?? $this->help();
        $this->field->placeholder = $this->field->placeholder ?? $this->placeholder();
    }

    public function help()
    {
        return $this->field->multiple
            ? __('tf::form.multiselect.help')
            : null;
    }

    public function placeholder()
    {
        return $this->field->multiple
            ? __('tf::form.multiselect.placeholder')
            : __('tf::form.select.placeholder');
    }

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
            $this->field->wire => $this->field->key,
            'name' => $this->field->key
        ];
        return array_merge($default, $custom);
    }

    public function class(): string
    {
        $class = ($this->field->multiple) ? "form-input my-1 w-full shadow px-0 divide-y " : "form-select my-1 w-full shadow ";
        $class .= $this->field->class;
        return Helpers::unique_words($class);
    }

    public function error(): string
    {
        return $this->class()." tf-field-error";
    }

    public function render(): View
    {
        return ($this->field->multiple) ? view('tall-forms::components.multiselect') : view('tall-forms::components.select');
    }
}
