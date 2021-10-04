<?php

namespace Tanthammar\TallForms;

class TagsSearch extends Tags
{
    public bool $allowNew = true;

    protected function overrides(): self
    {
        $this->type = 'tags-search';
        $this->align_label_top = true;
        $this->help = trans('tf::form.tags-search.help');
        $this->placeholder = trans('tf::form.tags-search.placeholder');
        $this->errorMsg = trans('tf::form.tags-search.error-msg');
        $this->rules = 'string|alpha_num|between:3,25';
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
