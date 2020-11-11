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
    public string $temp_key;
    public bool $is_selected;

    public function __construct(Field $field, string $tempKey, $selected = null)
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
        $this->is_selected = filled($selected);
    }

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
            $this->field->wire => $this->temp_key,
            'name' => $this->temp_key,
            'class' => $this->class()
        ];
        return array_merge($default, $custom);
    }

    public function class(): string
    {
        $class = ($this->field->multiple) ? "form-input my-1 w-full shadow " : "form-select my-1 w-full shadow ";
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
