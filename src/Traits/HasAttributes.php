<?php


namespace Tanthammar\TallForms\Traits;


trait HasAttributes
{
    public $attributes = [];

    public $xData;
    public $xInit;
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

    public function labelAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['label'], $attributes) : $this->attributes['label'] = $attributes;
        return $this;
    }

    public function afterLabelAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['after-label'], $attributes) : $this->attributes['after-label'] = $attributes;
        return $this;
    }

    public function beforeFieldAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['before-field'], $attributes) : $this->attributes['before-field'] = $attributes;
        return $this;
    }

    public function afterFieldWrapperAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['after-field-wrapper'], $attributes) : $this->attributes['after-field-wrapper'] = $attributes;
        return $this;
    }

    public function afterFieldAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['after-field'], $attributes) : $this->attributes['after-field'] = $attributes;
        return $this;
    }

    // don't know if I should use this yet
//    public function inputWrapperAttr(array $attributes, bool $merge = true): self
//    {
//        $merge ? array_merge($this->attributes['input-wrapper'], $attributes) : $this->attributes['input-wrapper'] = $attributes;
//        return $this;
//    }

    public function inputAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge($this->attributes['input'], $attributes) : $this->attributes['input'] = $attributes;
        return $this;
    }

    public function wire(string $wire_model_declaration): self
    {
        $this->wire = $wire_model_declaration;
        return $this;
    }
}
