<?php


namespace Tanthammar\TallForms;


use Tanthammar\TallForms\Traits\CanBeDisabled;

class Textarea extends BaseField
{
    use CanBeDisabled;

    public $textarea_rows = 5;
    public $placeholder;

    protected function overrides(): self
    {
        $this->type = 'textarea';
        $this->align_label_top = true;
        return $this;
    }

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

    public function inputAttr(array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }

}
