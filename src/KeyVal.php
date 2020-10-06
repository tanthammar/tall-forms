<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\IsArrayField;

class KeyVal extends BaseField
{
    use IsArrayField;

    public $type = 'keyval';
    public $align_label_top = true;
    public $allowed_in_array = false;

    public function __construct($label, $key)
    {
        parent::__construct($label, $key);
        $this->array_wrapper_class = config('tall-forms.field-attributes.keyval-wrapper');
        $this->array_wrapper_grid_class = config('tall-forms.field-attributes.keyval-wrapper-grid');
    }

}
