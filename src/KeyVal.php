<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HasSharedProperties;
use Tanthammar\TallForms\Traits\IsArrayField;

class KeyVal extends BaseField
{
    use HasSharedProperties, IsArrayField;

    public $type = 'keyval';

}
