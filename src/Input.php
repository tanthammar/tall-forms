<?php


namespace Tanthammar\TallForms;


use Illuminate\Support\Str;

class Input extends BaseField
{
    public $type = 'input';
    public $input_type = 'text';
    public $autocomplete;
    public $placeholder;
    public $prefix;
    public $icon;
    public $step = 1;
    public $min = 0;
    public $max = 100;
    public $wrapperClass = 'my-1 flex rounded-md shadow-sm w-full relative';


    public function inputWrapperClass(string $classes): self
    {
        $this->wrapperClass = $classes;
        return $this;
    }

    public function type(string $type): self
    {
        $this->input_type = $type;
        return $this;
    }

    public function autocomplete(string $autocomplete): self
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }

    public function prefix(string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function icon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    public function step(float $step): self
    {
        $this->step = $step;
        return $this;
    }


    public function min(float $min): self
    {
        $this->min = $min;
        return $this;
    }

    public function max(float $max): self
    {
        $this->max = $max;
        return $this;
    }

}
