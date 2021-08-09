<?php


namespace Tanthammar\TallForms;


class Checkbox extends BaseField
{

    public $placeholder;
    public string $checkboxLabelClass = "tf-checkbox-label";

    protected function overrides(): self
    {
        $this->type = 'checkbox';
        $this->wrapperClass = "flex";
        $this->class = "form-checkbox tf-checkbox";
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
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
