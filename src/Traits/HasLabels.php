<?php


namespace Tanthammar\TallForms\Traits;



trait HasLabels
{
    public $labelW;
    public $inlineLabelAlignment;
    public $labelSuffix;
    public $afterLabel;
    public $show_label = true;
    public $align_label_top = false;
    public $labelAsAttribute = true;

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

    public function labelAlign(string $class): self
    {
        $this->inlineLabelAlignment = $class;
        return $this;
    }

    public function labelSuffix(string $string): self
    {
        $this->labelSuffix = $string;
        return $this;
    }

    public function afterLabel(string $text): self
    {
        $this->afterLabel = $text;
        return $this;
    }

    public function hideLabel()
    {
        $this->show_label = false;
        return $this;
    }

    public function keyAsAttribute()
    {
        $this->labelAsAttribute = false;
        return $this;
    }

}
