<?php


namespace Tanthammar\TallForms;


class InputArray extends BaseField
{
    public string $input_type = 'text';

    protected function overrides(): self
    {
        $this->type = 'input-array';
        $this->show_label = false;
        $this->allowed_in_repeater = false;
        return $this;
    }


    /*
     * Search and Range is not allowed
     * <br>Text is default.
     */
    public function type(string $type): self
    {
        if (!in_array($type, ['search', 'range']))
            $this->input_type = $type;
        return $this;
    }
}
