<?php


namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\CanBeDisabled;
use Tanthammar\TallForms\Traits\HasOptions;
use Tanthammar\TallForms\Traits\HasSearchFeatures;

class Search extends BaseField
{
    use HasOptions, HasSearchFeatures, CanBeDisabled;

    protected function overrides(): self
    {
        $this->type = 'search';
        $this->align_label_top = true;
        return $this;
    }

}
