<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Textarea as Field;
use Tanthammar\TallForms\Traits\Helpers;

class Textarea extends Component
{
    use Helpers;

    public Field $field;
    public bool $required;

    public function __construct(Field $field)
    {
        $this->field = $field;
        $this->required = $field->required;
    }

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
            $this->field->wire => $this->field->key,
            'name' => $this->field->key,
            'placeholder' => $this->field->placeholder,
            'rows' => $this->field->textarea_rows,
        ];
        return array_merge($default, $custom);
    }

    public function class(): string
    {
        $class = "form-textarea block w-full rounded shadow-inner my-1 ";
        $class .= $this->field->class;
        return Helpers::unique_words($class);
    }

    public function error(): string
    {
        return $this->class()." tf-field-error";
    }

    public function render(): View
    {
        return view('tall-forms::components.textarea');
    }
}
