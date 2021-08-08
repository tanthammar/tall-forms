<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;

class InputArray extends BaseBladeField
{
    public function __construct(
        public array|object $field,
        public array $attr = [])
    {
        parent::__construct($field);
        $this->attr = array_merge($this->options(), $attr);
        $this->field->itemsArray = $this->field->defer ? "\$wire.entangle('".$this->field->key."').defer" : "\$wire.entangle('".$this->field->key."')";
    }

    public function defaults(): array
    {
        return [
            'id' => 'inputArray', //unique, fieldset id + label for =,
            'defer' => true,
            'type' => 'text',
            'wrapperClass' => null,
            'class' => "form-input my-1 w-full", //applied to each input
            'errorClass' => 'border rounded border-red-500 p-2 md:p-4 mb-2', //applied to the outer div surrounding the inputs
            'placeholder' => null,
            'errorMsg' => null,
            'maxItems' => 0, //0 = unlimited
            'minItems' => 0, //0 = unlimited
        ];
    }

    public function options(): array
    {
        return [
            'type' => $this->field->type,
            'placeholder' => $this->field->placeholder,
            'class' => $this->field->class,
        ];
    }


    public function render(): View
    {
        return view('tall-forms::components.input-array');
    }
}
