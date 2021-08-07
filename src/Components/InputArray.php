<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Traits\BaseBladeField;
use Tanthammar\TallForms\Traits\Helpers;

class InputArray extends Component
{
    public function __construct(
        public array|object $field,
        public array $attr = [])
    {
        $this->field = BaseBladeField::setDefaults($this->defaults(), $field);
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
            'class' => null,
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
            'class' => $this->class()
        ];
    }

    public function class(): string
    {
        return $this->field->class ?: "form-input my-1 w-full"; //example class from a default input field
    }


    public function render(): View
    {
        return view('tall-forms::components.input-array');
    }
}
