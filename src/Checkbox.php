<?php


namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HasOptions;

class Checkbox extends BaseField
{
    use HasOptions;

    public $type = 'checkbox';

    public function multiple(): self
    {
        $this->type = 'checkboxes';
        return $this;
    }

}
