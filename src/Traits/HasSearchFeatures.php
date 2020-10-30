<?php


namespace Tanthammar\TallForms\Traits;

/**
 * Used by sponsorpkg SearchList and basic Search
 * @package Tanthammar\TallForms\Traits
 */
trait HasSearchFeatures
{
    public $placeholder;
    public $searchKey = 'searchInput';
    public $displayValue = 'displayValue';
    public $debounce = 500;
    public string $listWidth;

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function searchKey(string $property): self
    {
        $this->searchKey = $property;
        return $this;
    }

    public function debounce(int $milliseconds): self
    {
        $this->debounce = $milliseconds;
        return $this;
    }

    public function listWidth(string $class): self
    {
        $this->listWidth = $class;
        return $this;
    }

}
