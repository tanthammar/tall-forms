<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\IsArrayField;

class KeyVal extends BaseField
{
    use IsArrayField;

    protected function overrides(): self
    {
        $this->type = 'keyval';
        $this->align_label_top = true;
        //$this->allowed_in_repeater = false;
        $this->allowed_in_keyval = true;
        $this->inline = false;
        $this->wire = '';
        $this->defaultErrorPosition = false;
        return $this;
    }
}
