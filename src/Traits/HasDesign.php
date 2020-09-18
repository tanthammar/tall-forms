<?php


namespace Tanthammar\TallForms\Traits;


trait HasDesign
{
    public $fieldW;
    public $inline;
    public $colspan = 12;
    public $class;
    public $inArray = false;

    /**
     * Default sm:w-2/3
     * @param $class
     * @return $this
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
     * @param int $cols
     * @return $this
     */
    public function colspan(int $cols): self
    {
        $this->colspan = $cols;
        return $this;
    }

    /**
     * Applied to the field wrapper
     * @param string $classes
     * @param bool $merge
     * @return $this
     */
    public function class(string $classes, $merge = true): self
    {
        $this->class = $merge ? "{$this->class} {$classes}" : $classes;
        return $this;
    }
}
