<?php


namespace Tanthammar\TallForms\Traits;


trait HasDesign
{
    public null|string $fieldW = null;
    public null|bool $inline = null;
    public null|int $colspan = 12;
    public null|string $class = null;
    public null|string $wrapperClass = null;
    public bool $inArray = false;

    /**
     * Default w-full sm:w-2/3
     * <br>Applying a class replaces default
     */
    public function fieldWidth(string $class): self
    {
        $this->fieldW = $class;
        return $this;
    }

    public function inline(): self
    {
        $this->inline = true;
        return $this;
    }

    public function stacked(): self
    {
        $this->inline = false;
        return $this;
    }

    /**
     * Default 12 of 12 columns
     */
    public function colspan(int $cols): self
    {
        $this->colspan = $cols;
        return $this;
    }

    /**
     * Applied to the field wrapper
     */
    public function class(string $classes, bool $merge = true): self
    {
        $this->class = $merge ? "$this->class $classes" : $classes;
        return $this;
    }
}
