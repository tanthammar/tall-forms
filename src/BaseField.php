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

    public $default;
    public $placeholder;

    public $help;
    public $errorMsg;

    protected $is_custom = false;


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

    public function custom(): BaseField
    {
        $this->is_custom = true;
        return $this;
    }

    public function default($default): BaseField
    {
        $this->default = $default;
        return $this;
    }


    public function help(string $help): BaseField
    {
        $this->help = $help;
        return $this;
    }


    /**
     * Add a custom error message displayed on field validation error
     * @param $string
     * @return $this
     */
    public function errorMsg(string $string): BaseField
    {
        $this->errorMsg = $string;
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
