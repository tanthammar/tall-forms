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
    public $align_label_top = true;

    /**
     * Radio constructor.
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

    public function class(): string
    {
        return "form-radio tall-forms-radio ";
    }


    public function render(): View
    {
        return view('tall-forms::components.radio');
    }
}
