<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Str;
use Tanthammar\TallForms\Traits\HasSharedProperties;
use Tanthammar\TallForms\Traits\IsArrayField;

class Repeater extends BaseField
{
    use HasSharedProperties, IsArrayField;

    public $type = 'array';
    public $array_sortable = false;

    public function sortable(): self
    {
        $this->array_sortable = true;
        return $this;
    }
}
