<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Str;
use Tanthammar\TallForms\Traits\IsArrayField;

class Repeater extends BaseField
{
    use IsArrayField;

    public $type = 'array';
    public $array_sortable = false;
    public $align_label_top = true;
    public $allowed_in_array = false;

    public function __construct($label, $key)
    {
        parent::__construct($label, $key);
        $this->array_wrapper_class = config('tall-forms.field-attributes.repeater-wrapper');
        $this->array_wrapper_grid_class = config('tall-forms.field-attributes.repeater-wrapper-grid');
    }

    public function sortable(): self
    {
        $this->array_sortable = true;
        return $this;
    }
}
