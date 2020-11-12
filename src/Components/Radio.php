<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Radio as Field;

class Radio extends Component
{
    public Field $field;
    public string $label;
    public $value;
    public $align_label_top = true;

    /**
     * Radio constructor.
     * @param Field $field
     * @param int|string $value
     * @param string $label
     */
    public function __construct(Field $field, $value, string $label)
    {
        $this->field = $field;
        $this->value = $value;
        $this->label = $label;
    }

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
            $this->field->wire => $this->field->key,
            'class' => $this->class()
        ];
        return array_merge($default, $custom);
    }

    public function class(): string
    {
        return "form-radio tf-radio ";
    }


    public function render(): View
    {
        return view('tall-forms::components.radio');
    }
}
