<?php


namespace Tanthammar\TallForms;


use Illuminate\Support\Str;

class Input
{

    protected string $label;
    protected string $key;
    protected string $type = 'text';
    protected string $wire = 'wire:model';
    protected array $attributes = [];
    private string $before;
    private string $after;
    private string $default;

    public function __construct(string $label, string $key)
    {
        $this->label = $label;
        $this->key = $key ?? Str::snake(Str::lower($label));
    }

    public static function make(string $label, $key = null): Input
    {
        return new static($label, $key);
    }

    public function type(string $type): Input
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }


    public function default($default): Input
    {
        $this->default = $default;
        return $this;
    }

    public function wire(string $wire_model_declaration): Input
    {
        $this->wire = $wire_model_declaration;
        return $this;
    }

    public function xData(string $xData): Input
    {
        $this->wire = $xData;
        return $this;
    }

    public function xInit(string $xInit): Input
    {
        $this->wire = $xInit;
        return $this;
    }

    public function before(string $blade_view_to_include): Input
    {
        $this->before = $blade_view_to_include;
        return $this;
    }

    public function after(string $blade_view_to_include): Input
    {
        $this->after = $blade_view_to_include;
        return $this;
    }

    public function rootAttr(array $attributes): Input
    {
        $this->attributes['root'] = $attributes;
        return $this;
    }

    public function labelAttr(array $attributes): Input
    {
        $this->attributes['label'] = $attributes;
        return $this;
    }

    public function wrapperAttr(array $attributes): Input
    {
        $this->attributes['label'] = $attributes;
        return $this;
    }

    public function inputAttr(array $attributes): Input
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }

}
