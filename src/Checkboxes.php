<?php


namespace Tanthammar\TallForms;


use Tanthammar\TallForms\Traits\CanBeDisabled;
use Tanthammar\TallForms\Traits\HasOptions;

class Checkboxes extends BaseField
{
    use HasOptions, CanBeDisabled;

    public string $checkboxLabelClass = "tf-checkbox-label";

    protected function overrides(): self
    {
        $this->type = 'checkboxes';
        $this->wrapperClass = "tf-checkboxes-fieldset";
        $this->class = "form-checkbox tf-checkbox";
        $this->align_label_top = true;
        $this->allowed_in_repeater = false;
        $this->has_array_value = true;
        //$this->rules_apply_to_each_item = true; Don't activate, use Rule:in([])
        return $this;
    }

    public function inputAttr(array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }

    public function checkboxLabelClass(string $class): self
    {
        $this->checkboxLabelClass = $class;
        return $this;
    }

}
