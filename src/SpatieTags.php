<?php


namespace Tanthammar\TallForms;


class SpatieTags extends BaseField
{
    public $type = 'spatie-tags';
    public $tagType = "";
    public $tagLocale;
    public $is_custom = true;
    public $searchError;
    public $searchRule = 'nullable|string|between:3,40';

    public function __construct($label, $key)
    {
        parent::__construct($label, $key);
        $this->searchError = trans(config('tall-forms.spatie-tags-search-error'));
    }

    public function type(string $tagType = ""): self
    {
        $this->tagType = $tagType;
        return $this;
    }

    public function suffix(string $tagTypeSuffix): self
    {
        $this->tagType .= "-{$tagTypeSuffix}";
        return $this;
    }

    public function locale(string $locale): self
    {
        $this->tagLocale = $locale;
        return $this;
    }

    public function searchError(string $errorText): self
    {
        $this->searchError = $errorText;
        return $this;
    }

    /**
     * @param array|string $rule
     * @return $this
     */
    public function searchRule($rule): self
    {
        $this->searchRule = $rule;
        return $this;
    }
}
