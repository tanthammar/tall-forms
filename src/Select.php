<?php


namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HasOptions;

class Select extends BaseField
{
    use HasOptions;

    public $placeholder;
    public $multiple = false;

    protected function overrides(): self
    {
        $this->type = 'select';
        $this->allowed_in_repeater = true;
        $this->align_label_top = false;
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    //renders a different view in the blade component class
    public function multiple(): self
    {
        $this->multiple = true;
        $this->type = 'multiselect';
        $this->align_label_top = true;
        $this->allowed_in_repeater = false;
        return $this;
    }

    public function inputAttr(array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }
}
