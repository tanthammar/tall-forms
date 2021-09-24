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
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }
}
