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
    public string $temp_key;
    public bool $required;

    public function __construct(Field $field, string $tempKey)
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
        $this->required = $field->required;
    }

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
            $this->field->wire => $this->temp_key,
            'name' => $this->temp_key,
            'placeholder' => $this->field->placeholder,
            'rows' => $this->field->textarea_rows,
        ];
        return array_merge($default, $custom);
    }

    public function class(): string
    {
        $class = "form-textarea block w-full rounded ";
        $class .= $this->field->class;
        return Helpers::unique_words($class);
    }

    public function error(): string
    {
        return $this->class()." tall-forms-field-error";
    }

    public function render(): View
    {
        return view('tall-forms::components.textarea');
    }
}
