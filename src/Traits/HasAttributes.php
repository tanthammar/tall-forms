<?php


namespace Tanthammar\TallForms\Traits;


use Illuminate\Support\Arr;

trait HasAttributes
{
    public array $attributes = [];

    public string $wire; // default = wire:model.lazy, in config/tall-forms, set in BaseField __construct()

    public function getAttr($type)
    {
        return data_get($this->attributes, $type, []);
    }

    public function setAttr()
    {
        $this->attributes = config('tall-forms.field-attributes');
        data_set($this->attributes, 'input', []);
        data_set($this->attributes, 'label', 'tf-label');
    }

    protected function mergeClasses(string $key, array $custom)
    {
        $merged = array_merge_recursive($this->attributes[$key], $custom);
        if(Arr::has($merged, 'class')) {
            $merged['class'] = implode(" ", $merged['class']);
        }
        $this->attributes[$key] = $merged;
    }

    public function rootAttr(array $attributes, bool $mergeClass = true): self
    {
        $mergeClass ? $this->mergeClasses('root', $attributes) : $this->attributes['root'] = $attributes;
        return $this;
    }

    public function beforeAttr(array $attributes, bool $mergeClass = true): self
    {
        $mergeClass ? $this->mergeClasses('before', $attributes) : $this->attributes['before'] = $attributes;
        return $this;
    }

    public function beforeText(array $attributes, bool $mergeClass = true): self
    {
        $mergeClass ? $this->mergeClasses('before-text', $attributes) : $this->attributes['before-text'] = $attributes;
        return $this;
    }

    public function aboveAttr(array $attributes, bool $mergeClass = true): self
    {
        $mergeClass ? $this->mergeClasses('above', $attributes) : $this->attributes['above'] = $attributes;
        return $this;
    }

    public function belowAttr(array $attributes, bool $mergeClass = true): self
    {
        $mergeClass ? $this->mergeClasses('below', $attributes) : $this->attributes['below'] = $attributes;
        return $this;
    }

    public function belowWrapperAttr(array $attributes, bool $mergeClass = true): self
    {
        $mergeClass ? $this->mergeClasses('below-wrapper', $attributes) : $this->attributes['below-wrapper'] = $attributes;
        return $this;
    }

    public function afterAttr(array $attributes, bool $mergeClass = true): self
    {
        $mergeClass ? $this->mergeClasses('after', $attributes) : $this->attributes['after'] = $attributes;
        return $this;
    }

    public function afterText(array $attributes, bool $mergeClass = true): self
    {
        $mergeClass ? $this->mergeClasses('after-text', $attributes) : $this->attributes['after-text'] = $attributes;
        return $this;
    }

    //observe, not an array
    public function labelClass(string $classes, bool $merge = true): self
    {
        $merge
            ? data_set($this->attributes, 'label', 'tf-label '. $classes)
            : data_set($this->attributes, 'label', $classes);
        return $this;
    }

    public function wire(string $wire_model_declaration): self
    {
        $this->wire = $wire_model_declaration;
        return $this;
    }
}
