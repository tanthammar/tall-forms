<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\IsArrayField;

class KeyVal extends BaseField
{
    use IsArrayField;

    public $type = 'keyval';

}
