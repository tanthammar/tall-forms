<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HasOptions;

class Choice extends BaseField
{
    use HasOptions;

    public $placeholder;
    public $multiple = false;

    protected function overrides(): self
    {
        $this->type = 'choice';
        $this->allowed_in_repeater = true;
        $this->align_label_top = false;

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
