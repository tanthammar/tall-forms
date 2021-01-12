<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Str;
use Tanthammar\TallForms\Traits\IsArrayField;

class Repeater extends BaseField
{
    use IsArrayField;

    public $labelEachRow = false;
    public $array_sortable = false;


    protected function overrides(): self
    {
        $this->type = 'array';
        $this->align_label_top = true;
        $this->allowed_in_repeater = false;
        $this->allowed_in_keyval = false;
        $this->inline = false;
        $this->wire = '';
        return $this;
    }


    public function sortable(): self
    {
        $this->array_sortable = true;
        return $this;
    }

    public function labelEachRow(): self
    {
        $this->labelEachRow = true;
        return $this;
    }
}
