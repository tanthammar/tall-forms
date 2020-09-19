<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Radio as Field;

class Radio extends Component
{
    public Field $field;
    public string $temp_key;
    public string $label;
    public $value;
    public string $optionsIdx;

    /**
     * Radio constructor.
     * @param Field $field
     * @param string $tempKey
     * @param int|string $value
     * @param string $label
     * @param string $optionsIdx
     */
    public function __construct(Field $field, string $tempKey, $value, string $label, string $optionsIdx)
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
        $this->value = $value;
        $this->label = $label;
        $this->optionsIdx = $optionsIdx;
    }

    public function options(): array
    {
        $custom = data_get($this->field, 'attributes.input');
        $default = [
            $this->field->wire => $this->temp_key,
            'class' => $this->class()
        ];
        return array_merge($default, $custom);
    }

    public function class()
    {
        return "form-radio mt-1 h-4 w-4 text-indigo-600 transition duration-150 ease-in-out ";
    }

    public function labelClass()
    {
        return 'text-sm leading-5 text-gray-900';
    }

    public function labelSpacingClass()
    {
        return 'ml-2 block';
    }

    public function render(): View
    {
        return view('tall-forms::components.radio');
    }
}
