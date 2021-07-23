<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tanthammar\TallForms\Traits\HasAttributes;
use Tanthammar\TallForms\Traits\HasDesign;
use Tanthammar\TallForms\Traits\HasLabels;
use Tanthammar\TallForms\Traits\HasSharedProperties;
use Tanthammar\TallForms\Traits\HasSlots;
use Tanthammar\TallForms\Traits\HasViews;

abstract class BaseField
{
    use HasLabels, HasAttributes, HasSharedProperties, HasDesign, HasViews, HasSlots;

    public string $name = "";
    public string $key = "";
    public string $type = 'input';
    public mixed $rules = 'nullable';

    public mixed $default = null;

    public bool $realtimeValidationOn = true;

    public bool $allowed_in_repeater = true;
    public bool $allowed_in_keyval = true;

    //Tabs, Groups, Panels and similar design elements that has a field array but should be ignored in form_data and validation
    public bool $ignored = false;

    public function __construct($label, $key)
    {
        $this->label = $label;
        $this->name = $key ?? Str::snake(Str::lower($label));
        $this->key = 'form_data.' . $this->name;
        $this->wire = config('tall-forms.field-attributes.wire');
        $this->xmodel = config('tall-forms.field-attributes.x-model');
        $this->deferEntangle = config('tall-forms.field-attributes.defer-entangle');
        $this->setAttr();
        $this->overrides();
    }

    public function getHtmlId($wireComponentID): string
    {
        return 'id'.md5($wireComponentID.$this->key);
    }

    //problem with collect()->firstWhere()
    /*public function __get($property)
    {
        return $this->$property;
    }*/

    protected function overrides(): self
    {
        return $this;
    }


    public static function make(string $label, string $key = null): static
    {
        return new static($label, $key);
    }

    /**
     * Standard Laravel validation syntax, default = 'nullable'
     * @param array|string $rules
     * @return $this
     */
    public function rules(mixed $rules): self
    {
        $this->rules = $rules;
        return $this;
    }

    public function default(mixed $default): self
    {
        $this->default = $default;
        return $this;
    }

    //used by SpatieTags
    public function fieldToArray(): array
    {
        $array = array();
        foreach ($this as $key => $value) {
            $array[$key] = is_array($value) ? (array) $value : $value;
        }
        return $array;
    }

    /**
     * Consider ->wire('defer') instead
     * @return $this
     */
    public function realtimeValidationOff(): self
    {
        $this->realtimeValidationOn = false;
        return $this;
    }
}
