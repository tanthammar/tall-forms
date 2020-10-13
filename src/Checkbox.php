<?php


namespace Tanthammar\TallForms;


class Checkbox extends BaseField
{

    public $type = 'checkbox';
    public $placeholder;

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function inputAttr(array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }

}
