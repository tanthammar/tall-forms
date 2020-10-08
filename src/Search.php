<?php


namespace Tanthammar\TallForms;


use Tanthammar\TallForms\Traits\HasOptions;

class Search extends BaseField
{
    use HasOptions;

    public $type = 'search';
    public $placeholder;

    public $optionsKey = 'searchOptions';
    public $searchKey = 'searchInput';
    public $displayValue = 'displayValue';
    public $debounce = 500;
    public $align_label_top = true;
    public $inlineLabel = true;
    public string $listWidth;

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function optionsKey(string $key): self
    {
        $this->optionsKey = $key;
        return $this;
    }

    public function searchKey(string $key): self
    {
        $this->searchKey = $key;
        return $this;
    }

    public function debounce(int $debounce): self
    {
        $this->debounce = $debounce;
        return $this;
    }

    /**
     * Display label and sublabel inline
     * @return $this|Search
     */
    public function inlineLabel()
    {
        $this->inlineLabel = true;
        return $this;
    }

    /**
     * Display label and sublabel on separate rows
     * @return $this|Search
     */
    public function stackedLabel()
    {
        $this->inlineLabel = false;
        return $this;
    }

    public function listWidth(string $class): self
    {
        $this->listWidth = $class;
        return $this;
    }

}
