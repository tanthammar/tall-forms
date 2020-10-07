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
    public $debounce = 500;
    public $align_label_top = true;

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

}
