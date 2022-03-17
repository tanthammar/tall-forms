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
    public bool $is_relation = false;
    public bool $is_custom = false;
    public bool $dynamicComponent = false;

    public string $label;
    public null|string $labelW = null;
    public null|string $fieldW = null;
    public string $name;
    public string $key;

    public bool $allowed_in_repeater = true;
    public bool $allowed_in_keyval = true;
    public bool $labelAsAttribute = true;

    // avoid render errors if not base field
    public string $view = '';
    public string $livewireComponent = '';
    public string $before = '';
    public string $beforeView = '';
    public string $afterView = '';
    public string $above = '';
    public string $below = '';
    public string $after = '';
    public string $help = '';
    public bool $align_label_top = false;
    public bool $inline = false;
    public string $afterLabel = '';
    public bool $show_label = false;
    public bool $inArray = false;

    public int $colspan = 12;
    public string $wire = '';


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

    //only needed to avoid errors in blade
    public function getAttr($type): array
    {
        return [];
    }

    /**
     * Default 12 of 12 columns
     * @param int $cols
     * @return $this
     */
    public function colspan(int $cols): self
    {
        $this->colspan = $cols;
        return $this;
    }

    public function setHtmlId(string $wireInstanceID): self
    {
        //applied in field-loop.php or Field::blade
        //$_instance->id
        $this->id = 'id' . md5($wireInstanceID . $this->key);
        return $this;
    }

}
