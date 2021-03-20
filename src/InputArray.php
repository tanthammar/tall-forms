<?php


namespace Tanthammar\TallForms;

/**
 * The Model attribute must be $cast to array
 * @package Tanthammar\TallForms
 */
class InputArray extends BaseField
{
    public string $input_type = 'text';
    public string $defer = ".defer";
    public string $placeholder = "";

    protected function overrides(): self
    {
        $this->type = 'input-array';
        $this->align_label_top = true;
        $this->allowed_in_repeater = false;
        return $this;
    }


    /**
     * Search and Range is not allowed
     * <br>Text is default.
     * @param string $type
     * @return InputArray
     */
    public function type(string $type): self
    {
        if (!in_array($type, ['search', 'range']))
            $this->input_type = $type;
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function showEmptyItem(): self
    {
        $this->default = [''];
        return $this;
    }

    /**
     * Entangle the field on every keystroke
     * @return $this
     */
    public function noDefer(): self
    {
        $this->defer = "";
        return $this;
    }
}
