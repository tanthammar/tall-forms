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

    public function __construct(Field $field, string $tempKey)
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
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
        $class = "form-select my-1 w-full shadow ";
        $class .= $this->field->class;
        return Helpers::unique_words($class);
    }

    public function error(): string
    {
        return $this->class()." tall-forms-field-error";
    }

    public function render(): View
    {
        return view('tall-forms::components.select');
    }
}
