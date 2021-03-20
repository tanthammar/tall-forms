<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Checkboxes as Field;

class Checkboxes extends Component
{
    public function __construct(
        public Field $field,
        public null|int|string $value = null,
        public ?string $label = null,
    ) {}

    public function options(): array
    {
        $custom = $this->field->getAttr('input');
        $default = [
//            $this->field->wire => $this->field->key,
            'x-model' => 'checkboxes',
            'class' => $this->class()
        ];
        return array_merge($default, $custom);
    }

    public function class(): string
    {
        return "form-checkbox tf-checkbox";
    }

    public function render(): View
    {
        return view('tall-forms::components.checkboxes');
    }
}
