<?php


namespace Tanthammar\TallForms\Traits;


trait HasAttributes
{
    public array $attributes = [];

    public $wire = 'wire:model.lazy';

    public function getAttr($type)
    {
        return data_get($this->attributes, $type, []);
    }

    public function setAttr()
    {
        $this->attributes = config('tall-forms.field-attributes');
        data_set($this->attributes, 'input', []);
    }

    public function rootAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['root'], $attributes) : $this->attributes['root'] = $attributes;
        return $this;
    }

    public function beforeAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['before'], $attributes) : $this->attributes['before'] = $attributes;
        return $this;
    }

    public function beforeText(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['before-text'], $attributes) : $this->attributes['before-text'] = $attributes;
        return $this;
    }

    public function aboveAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['above'], $attributes) : $this->attributes['above'] = $attributes;
        return $this;
    }

    public function belowAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['below'], $attributes) : $this->attributes['below'] = $attributes;
        return $this;
    }

    public function belowWrapperAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['below-wrapper'], $attributes) : $this->attributes['below-wrapper'] = $attributes;
        return $this;
    }

    public function afterAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['after'], $attributes) : $this->attributes['after'] = $attributes;
        return $this;
    }

    public function afterText(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['after-text'], $attributes) : $this->attributes['after-text'] = $attributes;
        return $this;
    }

    public function labelAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['label'], $attributes) : $this->attributes['label'] = $attributes;
        return $this;
    }

    public function labelSuffixAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['label-suffix'], $attributes) : $this->attributes['label-suffix'] = $attributes;
        return $this;
    }

    public function afterLabelAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['after-label'], $attributes) : $this->attributes['after-label'] = $attributes;
        return $this;
    }

    // don't know if I should use this yet
//    public function inputWrapperAttr(array $attributes, bool $merge = true): self
//    {
//        $merge ? array_merge($this->attributes['input-wrapper'], $attributes) : $this->attributes['input-wrapper'] = $attributes;
//        return $this;
//    }

    public function inputAttr(array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }

    public function wire(string $wire_model_declaration): self
    {
        $this->wire = $wire_model_declaration;
        return $this;
    }
}
