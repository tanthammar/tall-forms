<?php


namespace Tanthammar\TallForms\Traits;


use Tanthammar\TallForms\BaseField;
use Tanthammar\TallForms\Exceptions\InvalidArrayFieldType;

trait IsArrayField
{
    public $fields = [];
    public $array_wrapper_class;
    public $array_wrapper_grid_class;
    public $childCols;

    public function fields($fields = []): self
    {
        foreach ($fields as $field) {
            throw_if($this->type == 'array' && !$field->allowed_in_repeater,
                new InvalidArrayFieldType($field->name, $field->type, $this->type)
            );
            throw_if($this->type == 'keyval' && !$field->allowed_in_keyval,
                new InvalidArrayFieldType($field->name, $field->type, $this->type)
            );
        }
        $this->fields = $fields;
        return $this;
    }

    /**
     * Applied to the outer wrapper
     * <br>Only Repeater and Keyval
     * @param string $classes
     * @return $this
     */
    public function wrapperClass(string $classes): self
    {
        $this->array_wrapper_class = $classes;
        return $this;
    }

    /**
     * Only applied to Repeater and KeyVal
     * @param string $classes
     * @return $this
     */
    public function wrapperGrid(string $classes): self
    {
        $this->array_wrapper_grid_class = $classes;
        return $this;
    }

    /**
     * Overrides nested field->colspan() Default 12 of 12 columns
     * @param int $cols
     * @return $this
     */
    public function childColspan(int $cols): self
    {
        $this->childCols = $cols;
        return $this;
    }

    //Redundant
/*    public function fieldToArray()
    {
        $array = [];
        if (filled($this->fields)) {
            foreach ($this->fields as $field) {
                $field->key = $this->key.'.'.$field->name;
                $array[] = (array)$field;
            }
        }
//        $array['parent'] = $this->key;
        return $array;
    }*/

}
