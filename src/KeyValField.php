<?php

namespace Tanthammar\TallForms;

class KeyValField extends BaseField
{
    protected $show_label = true;

    public function __construct($label, $name)
    {
        $this->label = $label;
        $this->name = $name ?? \Str::snake(\Str::lower($label));
    }

    public static function make($label, $name = null)
    {
        return new static($label, $name);
    }

    public function hideLabel()
    {
        $this->show_label = false;
        return $this;
    }
}
