<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\IsArrayField;

class KeyVal extends BaseField
{
    use IsArrayField;

    public $type = 'keyval';

    public function init()
    {
        $this->align_label_top = true;
        $this->allowed_in_repeater = false;
        $this->allowed_in_keyval = true;
        $this->inline = false;
        return $this;
    }
}
