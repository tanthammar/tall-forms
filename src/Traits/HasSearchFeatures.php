<?php


namespace Tanthammar\TallForms\Traits;

/**
 * Used by sponsorpkg SearchList and basic Search
 * @package Tanthammar\TallForms\Traits
 */
trait HasSearchFeatures
{
    public $placeholder;
    public $optionsKey = 'searchOptions';
    public $searchKey = 'searchInput';
    public $displayValue = 'displayValue';
    public $debounce = 500;
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

    public function listWidth(string $class): self
    {
        $this->listWidth = $class;
        return $this;
    }

}
