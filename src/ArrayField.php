<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Str;
use Tanthammar\TallForms\Traits\HasSharedProperties;

class ArrayField extends BaseField
{
    use HasSharedProperties;

    public $type = 'array';
    public $array_fields = [];
    public $keyval_fields = [];
    public $array_sortable = false;
    public $group_class = 'rounded border bg-gray-50';

    public function repeater($fields = []): self
    {
        $this->type = 'array';
        $this->array_fields = $fields;
        return $this;
    }

    public function keyval($fields = []): self
    {
        $this->type = 'keyval';
        $this->keyval_fields = $fields;
        return $this;
    }

    public function sortable(): self
    {
        if ($this->type === 'array') $this->array_sortable = true;
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
        $fields = $this->array_fields ?? $this->keyval_fields;
        if(filled($fields)) {
            foreach ($fields as $field) {
                $array[] = (array) $field;
            }
        }
        $array[$this->key] = $array;
        return $array;
    }
}
