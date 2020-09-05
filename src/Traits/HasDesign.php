<?php


namespace Tanthammar\TallForms\Traits;


trait HasDesign
{
    public $fieldW = 'sm:w-2/3';
    public $inline;
    public $colspan = 12;
    public $class;

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

    public function inline(bool $inline = true): self
    {
        $this->inline = $inline;
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
     * @return $this
     */
    public function class(string $classes): self
    {
        $this->class = $classes;
        return $this;
    }
}
