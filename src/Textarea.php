<?php


namespace Tanthammar\TallForms;


class Textarea extends BaseField
{
    public $type = 'textarea';
    public $textarea_rows = 5;
    public $placeholder;
    public $required = false;
    public $align_label_top = true;

    public function rows(int $rows = 5): Textarea
    {
        $this->textarea_rows = $rows;
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function required(): self
    {
        $this->required = true;
        return $this;
    }

    public function inputAttr(array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }
    
}
