<?php


namespace Tanthammar\TallForms;

/**
 * The Model attribute must be $cast to array
 * @package Tanthammar\TallForms
 */
class InputArray extends BaseField
{
    public string $input_type = 'text';
    public string $placeholder = "";
    public int $maxItems = 0;
    public int $minItems = 0;

    protected function overrides(): self
    {
        $this->type = 'input-array';
        $this->align_label_top = true;
        $this->allowed_in_repeater = false;
        $this->deferEntangle();
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

    public function showEmptyItem($count = 1): self
    {
        $this->default = [''];
        if ($count >= 2) {
            for ($i = 2; $i <= $count; $i++) {
                $this->default[] = '';
            }
        }
        return $this;
    }

    /**
     * Entangle the field on every keystroke
     * @deprecated deprecated since version 8.0
     * <br> replaced with deferEntangle(bool true/false) in BaseField
     *
     * @return $this
     */
    public function noDefer(): self
    {
        $this->deferEntangle(false);
        return $this;
    }

    public function minItems(int $min = 1): self
    {
        if($min >= 1) $this->minItems = $min;
        $this->showEmptyItem($min);
        return $this;
    }

    public function maxItems(int $max = 0): self
    {
        if($max >= 1) $this->maxItems = $max;
        return $this;
    }
}
