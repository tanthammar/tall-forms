<?php


namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HasOptions;

class Select extends BaseField
{
    use HasOptions;

    public $type = 'select';
    public $placeholder;
    public $multiple = false;
    public $allowed_in_array = true;

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    //renders a different view in the blade component class
    public function multiple(): self
    {
        $this->multiple = true;
        return $this;
    }

    public function inputAttr(array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }
}
