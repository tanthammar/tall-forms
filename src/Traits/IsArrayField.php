<?php


namespace Tanthammar\TallForms\Traits;


trait IsArrayField
{
    public $fields = [];
    public $group_class = 'rounded border bg-gray-50';

    public function fields($fields = []): self
    {
        foreach($fields as $field) {
            if (in_array($field->type, ['array', 'keyval'])) {
                //TODO throw real error
                dd('you are not allowed to add arrays or keyval field to this type of field');
            }
        }
        $this->fields = $fields;
        return $this;
    }

    /**
     * Applied to the outer wrapper surrounding Array and KeyVal field groups
     * Default 'rounded border bg-gray-50';
     *
     * @param $classes
     * @return $this
     */
    public function groupClass(string $classes = 'rounded border bg-gray-50'): self
    {
        $this->group_class = $classes;
        return $this;
    }

    //TODO check if this is working
    //override FieldBase fieldToArray()
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
