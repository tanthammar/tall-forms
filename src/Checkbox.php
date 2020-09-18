<?php


namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HasOptions;

class Checkbox extends BaseField
{
    use HasOptions;

    public $type = 'checkbox';
    public $placeholder;

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }
}
