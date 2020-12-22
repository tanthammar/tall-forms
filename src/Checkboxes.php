<?php


namespace Tanthammar\TallForms;


use Tanthammar\TallForms\Traits\HasOptions;

class Checkboxes extends BaseField
{
    use HasOptions;

    public $type = 'checkboxes';

    public function init ()
    {
        $this->align_label_top = true;
        $this->allowed_in_repeater = true;
        return $this;
    }

    public function inputAttr (array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }

}
