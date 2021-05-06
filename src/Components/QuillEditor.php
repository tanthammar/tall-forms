<?php

namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\QuillEditor as Field;
use Tanthammar\TallForms\Traits\Helpers;

class QuillEditor extends Component
{
    use Helpers;

    public Field $field;
    public ?string $value;

    public function __construct(Field $field, ?string $value = null)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /* class
     * get/set classes for quill component
     * @author Arif Pavel
     * @since 03 May 21
     * @version v8.0.0
     * @param mixed
     * @return null
    */
    public function class(): string
    {
        $class = "w-full shadow-inner form-textarea ";
        $class .= $this->field->class;

        return Helpers::unique_words($class);
    }

    /* error
     * add error class on error occured.
     * @author Arif Pavel
     * @since 03 May 21
     * @version v8.0.0
     * @param mixed
     * @return null
    */
    public function error(): string
    {
        return $this->class() . " tf-field-error";
    }

    /* render
     * quill component renderer
     * @author Arif Pavel
     * @since 03 May 21
     * @version v8.0.0
     * @param mixed
     * @return null
    */
    public function render(): View
    {
        return view('tall-forms::components.quill-editor');
    }
}
