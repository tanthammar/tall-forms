<?php


namespace Tanthammar\TallForms;


class SpatieTags extends BaseField
{
    public $type = 'spatie-tags';
    public $tagType = "";
    public $tagLocale;
    public $is_custom = true;
    public $tagsRules;
    public $placeholder;
    public $align_label_top = true;
    public $allowed_in_repeater = false;
    public $allowed_in_keyval = false;
    public $allowed_in_tab = false;

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

    public function rules($rules): self
    {
        $this->tagsRules = $rules;
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }
}
