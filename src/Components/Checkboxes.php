<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Checkboxes as Field;

class Checkboxes extends Component
{
    public Field $field;
    public string $temp_key;
    public string $label;
    public $value;

    /**
     * Checkboxes constructor.
     * @param Field $field
     * @param string $tempKey
     * @param int|string $value
     * @param string $label
     */
    public function __construct(Field $field, string $tempKey, $value, string $label)
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
        $this->value = $value;
        $this->label = $label;
    }

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
            $this->field->wire => $this->temp_key,
            'class' => $this->class()
        ];
        return array_merge($default, $custom);
    }

    public function class()
    {
        return "form-checkbox mt-1 h-4 w-4 text-indigo-600 transition duration-150 ease-in-out ";
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
        return view('tall-forms::components.checkboxes');
    }
}
