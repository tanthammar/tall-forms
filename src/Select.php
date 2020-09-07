<?php


namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HasOptions;

class Select extends BaseField
{
    use HasOptions;

    public $type = 'select';
    public $placeholder;
    public $multiple = false;

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    //TODO add support for mulitple select
    public function multiple(): self
    {
        $this->type = 'multiselect';
        $this->multiple = true;
        return $this;
    }
}
