<?php


namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HasOptions;
use Tanthammar\TallForms\Traits\HasSharedProperties;

class Checkbox extends BaseField
{
    use HasSharedProperties, HasOptions;

    public $type = 'checkbox';

    public function multiple(): self
    {
        $this->type = 'checkboxes';
        return $this;
    }

}
