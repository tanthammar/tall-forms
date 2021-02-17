<?php


namespace Tanthammar\TallForms;

class MultiSelect extends Select
{
    public $multiple = true;

    protected function overrides(): self
    {
        $this->type = 'multiselect';
        $this->allowed_in_repeater = false;
        $this->align_label_top = true;
        $this->allowed_in_repeater = false;
        return $this;
    }

    //legacy override Select, all values already set in overrides()
    public function multiple(): self
    {
        return $this;
    }
}
