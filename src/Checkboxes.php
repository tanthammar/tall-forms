<?php


namespace Tanthammar\TallForms;


use Tanthammar\TallForms\Traits\HasOptions;

class Checkboxes extends BaseField
{
    use HasOptions;

    protected function overrides(): self
    {
        $this->type = 'checkboxes';
        $this->align_label_top = true;
        $this->allowed_in_repeater = true;
        return $this;
    }

    public function inputAttr(array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }

}
