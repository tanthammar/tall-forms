<?php


namespace Tanthammar\TallForms\Traits;


use Tanthammar\TallForms\BaseField;

trait IsArrayField
{
    public $fields = [];
    public $array_wrapper_class = 'rounded border bg-gray-50';

    public function fields($fields = []): self
    {
        foreach($fields as $field) {
            if (!in_array($field->type, ['input', 'textarea', 'trix', 'range', 'checkbox', 'checkboxes', 'radio', 'select', 'multiselect'])) {
                //TODO throw real error
                dd('You can not add this field-type to Repeater or KeyVal fields');
            }
        }
        $this->fields = $fields;
        return $this;
    }

    /**
     * Applied to the outer wrapper surrounding Array and KeyVal field groups
     * Default 'rounded border bg-gray-50';
     *
     * @param string $classes
     * @return $this
     */
    public function wrapperClass(string $classes): self
    {
        $this->array_wrapper_class = $classes;
        return $this;
    }

    public function fieldToArray() {
        $array = [];
        if(filled($this->fields)) {
            foreach ($this->fields as $field) {
                $array[] = (array) $field;
            }
        }
        $array[$this->key] = $array;
        return $array;
    }

}
