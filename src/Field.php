<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Str;

class Field extends BaseField
{
    protected $label;
    protected $key;
    protected $multiple = false;
    protected $array_fields = [];
    protected $keyval_fields = [];
    protected $array_sortable = false;
    protected $view;
    protected $livewireComponent;
    protected $livewireParams;
    protected $tagType;
    protected $tagLocale;
    protected $inline;
    protected $cropperAttributes;
    public $includeScript;


    public function __construct($label, $name)
    {
        $this->label = $label;
        $this->name = $name ?? Str::snake(Str::lower($label));
        $this->key = 'form_data.' . $this->name;
    }


    public static function make($label, $name = null)
    {
        return new static($label, $name);
    }

    public function file(): Field
    {
        $this->is_custom = true;
        $this->type = 'file';
        return $this;
    }

    public function multiple(): Field
    {
        $this->multiple = true;
        return $this;
    }

    public function array($fields = []): Field
    {
        $this->type = 'array';
        $this->array_fields = $fields;
        return $this;
    }

    public function keyval($fields = []): Field
    {
        $this->type = 'keyval';
        $this->keyval_fields = $fields;
        return $this;
    }

    public function tags(string $tagType = "", string $tagTypeSuffix = null, string $locale = null): Field
    {
        $this->is_custom = true;
        $this->type = 'tags';
        $this->tagType = filled($tagTypeSuffix) ? $tagType . '-' . $tagTypeSuffix : $tagType;
        $this->tagLocale = $locale;
        return $this;
    }

    public function sortable(): Field
    {
        $this->array_sortable = true;
        return $this;
    }

    /**
     * Display a custom view instad of the default field view
     * @param string $view
     * @return $this
     */
    public function view(string $view): BaseField
    {
        $this->view = $view;
        return $this;
    }

    public function livewireComponent(string $component, array $params = []): BaseField
    {
        $this->livewireComponent = $component;
        $this->livewireParams = $params;
        return $this;
    }

    public function inline(bool $inline = true): BaseField
    {
        $this->inline = $inline;
        return $this;
    }

    public function singleImgCropper($includeScript = false, $cropperAttributes = [
        'width' => 300,
        'height' => 300,
        'shape' => 'square', //or circle
    ]): Field
    {
        $this->is_custom = true;
        $this->type = 'single-croppie';
        $this->includeScript = $includeScript;
        $this->cropperAttributes = $cropperAttributes;
        return $this;
    }
}
