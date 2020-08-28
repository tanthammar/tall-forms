<?php


namespace Tanthammar\TallForms;


class Tags extends BaseField
{
    public $type = 'tags';
    public $tagType = "";
    public $tagLocale;
    public $is_custom = true;

    public function tags(string $tagType = "", string $tagTypeSuffix = null, string $locale = null): self
    {
        $this->tagType = filled($tagTypeSuffix) ? $tagType . '-' . $tagTypeSuffix : $tagType;
        $this->tagLocale = $locale;
        return $this;
    }
}
