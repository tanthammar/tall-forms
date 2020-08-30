<?php


namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HasOptions;
use Tanthammar\TallForms\Traits\HasSharedProperties;

class Select extends BaseField
{
    use HasSharedProperties, HasOptions;

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
