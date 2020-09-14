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
    public $required = false;

    public function __construct($label, $key)
    {
        parent::__construct($label, $key);
        $this->class .= config('tall-forms.field-attributes.input');
    }

    public function type(string $type): self
    {
        if($type == 'hidden') {
            $this->type = 'hidden';
            return $this;
        }
        if($type == 'range') {
            $this->type = 'range';
            return $this;
        }
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

    public function required(): self
    {
        $this->required = true;
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
