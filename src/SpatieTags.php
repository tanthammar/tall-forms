<?php


namespace Tanthammar\TallForms;


class SpatieTags extends BaseField
{
    public $tagType = "";
    public $tagLocale;
    public $tagsRules;
    public $placeholder;

    protected function overrides(): self
    {
        $this->type = 'spatie-tags';
        $this->is_custom = true;
        $this->align_label_top = true;
        $this->allowed_in_repeater = false;
        $this->allowed_in_keyval = false;
        $this->placeholder = __('tf::form.spatie-tags.placeholder');
        $this->help = __('tf::form.spatie-tags.help'); //default = "Add tag ..."
        $this->tagsRules = 'string|between:3,50';
        return $this;
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
