<?php


namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HasOptions;
use Tanthammar\TallForms\Traits\HasSearchFeatures;

class Search extends BaseField
{
    use HasOptions, HasSearchFeatures;

    public $type = 'search';
    public $align_label_top = true;

}
