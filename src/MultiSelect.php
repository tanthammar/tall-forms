<?php


namespace Tanthammar\TallForms;

class MultiSelect extends Select
{
    public $multiple = true;

    protected function overrides(): self
    {
        $this->type = 'multiselect';
        $this->align_label_top = true;
        $this->allowed_in_repeater = false;
        $this->help = __('tf::form.multiselect.help');
        $this->has_array_value = true;
        //$this->rules_apply_to_each_item = true; Don't activate, use Rule:in([])
        return $this;
    }

    //legacy override Select, all values already set in overrides()
    public function multiple(): self
    {
        return $this;
    }
}
