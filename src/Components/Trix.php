<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Trix as Field;
use Tanthammar\TallForms\Traits\Helpers;

class Trix extends Component
{
    use Helpers;

    public Field $field;
    public string $temp_key;
    public ?string $value;

    public function __construct(Field $field, string $tempKey, ?string $value = null)
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
        $this->value = $value;
    }

    public function class(): string
    {
        $class = "form-textarea w-full shadow-inner ";
        $class .= $this->field->class;
        return Helpers::unique_words($class);
    }

    public function error(): string
    {
        return $this->class() . " tf-field-error";
    }

    public function render(): View
    {
        if($this->field->allowAttachments) return view('tall-forms-sponsors::components.trix-with-attachments');
        return view('tall-forms::components.trix');
    }
}
