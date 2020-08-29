<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Arr;
use Tanthammar\TallForms\Traits\HasAttributes;
use Tanthammar\TallForms\Traits\HasDesign;
use Tanthammar\TallForms\Traits\HasLabels;

class BaseField
{
    use HasLabels, HasAttributes, HasDesign;

    public $label;
    public $key;
    public $type = 'input';
    public $rules = 'nullable';

    public $default;
    public $placeholder;
    public $help;

    public $errorMsg;
    public $xData;
    public $xInit;
    public $wire = 'wire:model.lazy';


    public function __construct($label, $key)
    {
        $this->label = $label;
        $this->key = $key ?? \Str::snake(\Str::lower($label));
    }


    public static function make($label, $key = null)
    {
        return new static($label, $key);
    }

//    public function __get($property)
//    {
//        return $this->$property;
//    }

    /**
     * Standard Laravel validation syntax, default = 'nullable'
     * @param array|string $rules
     * @return $this
     */
    public function rules($rules): self
    {
        $this->rules = $rules;
        return $this;
    }

    public function default($default): self
    {
        $this->default = $default;
        return $this;
    }


    public function help(string $help): self
    {
        $this->help = $help;
        return $this;
    }


    /**
     * Add a custom error message displayed on field validation error
     * @param $string
     * @return $this
     */
    public function errorMsg(string $string): self
    {
        $this->errorMsg = $string;
        return $this;
    }

    public function xData(string $xData): self
    {
        $this->xData = $xData;
        return $this;
    }

    public function xInit(string $xInit): self
    {
        $this->xInit = $xInit;
        return $this;
    }

    public function wire(string $wire_model_declaration): self
    {
        $this->wire = $wire_model_declaration;
        return $this;
    }

    //ArrayField has override
    public function fieldToArray() {
        $array = array();
        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }
        return $array;
    }
}
