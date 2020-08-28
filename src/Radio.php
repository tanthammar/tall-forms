<?php


namespace Tanthammar\TallForms;


use Tanthammar\TallForms\Traits\HasOptions;
use Tanthammar\TallForms\Traits\HasSharedProperties;

class Radio extends BaseField
{
    use HasSharedProperties, HasOptions;

    public $type = 'radio';

}
