<?php


namespace Tanthammar\TallForms;


use Tanthammar\TallForms\Traits\CanBeDisabled;

class Range extends BaseField
{
    use CanBeDisabled;

    public $step = 1;
    public $min = 1;
    public $max = 100;

    protected function overrides(): self
    {
        $this->type = 'range';
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

    public function inputAttr(array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }

}
