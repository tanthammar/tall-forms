<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\CanBeDisabled;
use Tanthammar\TallForms\Traits\HasOptions;
use Tanthammar\TallForms\Traits\HasSearchFeatures;

class TagsSearch extends BaseField
{
    use HasOptions, HasSearchFeatures, CanBeDisabled;

    public bool $allowNew = true;

    protected function overrides(): self
    {
        $this->type = 'tags-search';
        $this->align_label_top = true;
        $this->help = trans('tf::form.tags-search.help');
        $this->placeholder = trans('tf::form.tags-search.placeholder');
        $this->errorMsg = trans('tf::form.tags-search.error-msg');
        $this->rules = 'string|alpha_dash|between:3,25';
        $this->allowed_in_repeater = false;
        $this->default = [];
        $this->has_array_value = true;
        return $this;
    }

    public function disableNew(): self
    {
        $this->allowNew = false;
        return $this;
    }

    public function allowNew(): self
    {
        $this->allowNew = true;
        return $this;
    }
}
