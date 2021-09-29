<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\CanBeDisabled;

class Tags extends BaseField
{
    use CanBeDisabled;

    public string $placeholder = "";

    protected function overrides(): self
    {
        $this->type = 'tags';
        $this->align_label_top = true;
        $this->help = trans('tf::form.tags.help');
        $this->placeholder = trans('tf::form.tags.placeholder');
        $this->errorMsg = trans('tf::form.tags.error-msg');
        $this->rules = 'string|alpha_num|between:3,25';
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }
}
