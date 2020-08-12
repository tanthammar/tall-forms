<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Str;

class Field extends BaseField
{
    protected $label;
    protected $key;
    protected $file_multiple;
    protected $array_fields = [];
    protected $keyval_fields = [];
    protected $array_sortable = false;
    protected $view;
    protected $livewireComponent;
    protected $livewireParams;


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
        $this->type = 'file';
        return $this;
    }

    public function multiple(): Field
    {
        $this->file_multiple = true;
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
}
