<?php


namespace Tanthammar\TallForms\Traits;


use Tanthammar\TallForms\BaseField;
use Tanthammar\TallForms\Exceptions\InvalidArrayFieldType;

trait IsArrayField
{
    public $fields = [];
    public $array_wrapper_class;
    public $array_wrapper_grid_class;

    public function fields($fields = []): self
    {
        foreach ($fields as $field) {
            throw_if(!$field->allowed_in_array,
                new InvalidArrayFieldType($field->name, $field->type)
            );
        }
        $this->fields = $fields;
        return $this;
    }

    /**
     * Applied to the outer wrapper surrounding Array and KeyVal field groups
     *
     * @param string $classes
     * @return $this
     */
    public function wrapperClass(string $classes): self
    {
        $this->array_wrapper_class = $classes;
        return $this;
    }

    public function wrapperGrid(string $classes): self
    {
        $this->array_wrapper_grid_class = $classes;
        return $this;
    }

    public function fieldToArray()
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
    }

}
