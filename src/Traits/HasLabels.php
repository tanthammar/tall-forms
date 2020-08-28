<?php


namespace Tanthammar\TallForms\Traits;



trait HasLabels
{
    public $labelW = 'sm:w-1/3';
    public $labelSuffix;
    /**
     * Used only in inline form
     * Default sm:w-1/3
     * @param string $class
     * @return $this
     */
    public function labelWidth(string $class): self
    {
        $this->labelW = $class;
        return $this;
    }

    public function labelSuffix(string $string): self
    {
        $this->labelSuffix = $string;
        return $this;
    }

}
