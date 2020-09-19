<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Select as Field;
use Tanthammar\TallForms\Traits\Helpers;

class Select extends Component
{
    public Field $field;
    public string $temp_key;

    public function __construct(Field $field, string $tempKey)
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
    }

    public function options(): array
    {
        $custom = data_get($this->field, 'attributes.input');
        $default = [
            $this->field->wire => $this->temp_key,
            'name' => $this->temp_key,
            'class' => $this->class()
        ];
        return array_merge($default, $custom);
    }

    public function class()
    {
        $class = "form-select my-1 w-full ";
        $class .= $this->field->class;
        return Helpers::unique_words($class);
    }

    public function error()
    {
        return Helpers::unique_words($this->class()." border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red");
    }

    public function render(): View
    {
        return view('tall-forms::components.select');
    }
}
