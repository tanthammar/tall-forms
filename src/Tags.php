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
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }
}
