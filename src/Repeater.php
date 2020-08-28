<?php

namespace Tanthammar\TallForms;

class Repeater extends BaseField
{
    public $show_label = false;

    public function __construct($label, $name)
    {
        $this->label = $label;
        $this->name = $name ?? \Str::snake(\Str::lower($label));
    }

    public static function make($label, $name = null)
    {
        return new static($label, $name);
    }

    public function showLabel()
    {
        $this->show_label = true;
        return $this;
    }
}
