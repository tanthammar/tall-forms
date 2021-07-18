<?php


namespace Tanthammar\TallForms\Traits;


trait HasSlots
{
    public null|string $before = null;
    public null|string $after = null;
    public null|string $above = null;
    public null|string $below = null;
    public null|string $help = null;
    public null|string $errorMsg = null;

    public function before(string $text): self
    {
        $this->before = $text;
        return $this;
    }

    public function after(string $text): self
    {
        $this->after = $text;
        return $this;
    }

    public function above(string $text): self
    {
        $this->above = $text;
        return $this;
    }

    public function below(string $text): self
    {
        $this->below = $text;
        return $this;
    }

    public function help(string $help): self
    {
        $this->help = $help;
        return $this;
    }

    /**
     * Add a custom error message displayed on field validation error
     */
    public function errorMsg(string $string): self
    {
        $this->errorMsg = $string;
        return $this;
    }

}
