<?php

namespace Tanthammar\TallForms\Traits;

trait CanBeDisabled
{
    public bool $disabled = false;
    public function disabled(bool $state = true): self
    {
        $this->disabled = $state;
        return $this;
    }
}
