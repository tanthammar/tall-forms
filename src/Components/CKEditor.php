<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\CKEditor as Field;
use Tanthammar\TallForms\Traits\Helpers;

class CKEditor extends Component
{
    use Helpers;

    public Field $field;
    public ?string $value;

    public function __construct(Field $field, ?string $value = null)
    {
        $this->field = $field;
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
        return view('tall-forms::components.ckeditor'.($this->field->editorTypeKey === "classic" ? '-classic' : ''));
    }
}
