<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\IsArrayField;

class KeyVal extends BaseField
{
    use IsArrayField;

    public $type = 'keyval';
    public $align_label_top = true;
    public $allowed_in_array = true;
}
