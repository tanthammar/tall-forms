<?php


namespace Tanthammar\TallForms\Traits;


trait HasDesign
{
    public $fieldW = 'sm:w-2/3';
    public $inline;
    public $colspan = 6;
    public $before;
    public $after;
    public $view;
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
     * Default 6 of 6 columns
     * @param int $cols
     * @return $this
     */
    public function colspan(int $cols): self
    {
        $this->colspan = $cols;
        return $this;
    }

    public function before(string $blade_view_to_include): self
    {
        $this->before = $blade_view_to_include;
        return $this;
    }

    public function after(string $blade_view_to_include): self
    {
        $this->after = $blade_view_to_include;
        return $this;
    }

    /**
     * Display a custom view instad of the default field view
     * @param string $view
     * @return $this
     */
    public function view(string $your_on_your_own_blade_view): self
    {
        $this->view = $your_on_your_own_blade_view;
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
