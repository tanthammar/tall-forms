<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\IsArrayField;

class KeyVal extends BaseField
{
    use IsArrayField;

    public $type = 'keyval';
    public $align_label_top = true;
    public $allowed_in_repeater = false;
    public $allowed_in_keyval = true;
    public $allowed_in_tab = true;
}
