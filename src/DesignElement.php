<?php


namespace Tanthammar\TallForms;


use Illuminate\Support\Str;
use Tanthammar\TallForms\Traits\HasAttributes;
use Tanthammar\TallForms\Traits\HasDesign;
use Tanthammar\TallForms\Traits\HasIcons;
use Tanthammar\TallForms\Traits\HasSharedProperties;
use Tanthammar\TallForms\Traits\HasViews;

class DesignElement
{
    use HasIcons;

    public bool $ignored = true;

    public string $label;
    public string $name;
    public string $key;

    public bool $allowed_in_repeater = true;
    public bool $allowed_in_keyval = true;
    public bool $labelAsAttribute = true;


    public function __construct($label, $key)
    {
        $this->label = $label;
        $this->name = $key ?? Str::snake(Str::lower($label));
        $this->key = 'form_data.' . $this->name;
    }

    public static function make(string $label, string $key = null)
    {
        return new static($label, $key);
    }

}
