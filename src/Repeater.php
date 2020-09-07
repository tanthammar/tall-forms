<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Str;
use Tanthammar\TallForms\Traits\IsArrayField;

class Repeater extends BaseField
{
    use IsArrayField;

    public $type = 'array';
    public $array_sortable = false;

    public function sortable(): self
    {
        $this->array_sortable = true;
        return $this;
    }
}
