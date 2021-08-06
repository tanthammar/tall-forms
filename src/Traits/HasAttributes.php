<?php


namespace Tanthammar\TallForms\Traits;


use Illuminate\Support\Arr;

trait HasAttributes
{
    public array $attributes = [];

    public null|string $wire = null; // config('tall-forms.field-attributes.wire'), applied in BaseBladeField::setDefaults()
    public null|string $xmodel = null; // config('tall-forms.field-attributes.x-model'), applied in BaseBladeField::setDefaults()
    public null|bool $deferEntangle = null; // config('tall-forms.field-attributes.defer-entangle'), applied in BaseBladeField::setDefaults()

    public function getAttr($type): mixed
    {
        return data_get($this->attributes, $type, []);
    }

    public function setAttr(): void
    {
        $this->attributes = config('tall-forms.field-attributes');
        data_set($this->attributes, 'input', []);
    }

    protected function mergeClasses(string $key, array $custom): void
    {
        $merged = array_merge_recursive($this->attributes[$key], $custom);
        if (Arr::has($merged, 'class')) {
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

    /**
     * Example ->wire('debounce.500ms')
     */
    public function wire(string $on = 'wire:model'): self
    {
        //handled in BaseBladeField->setDefaults()
        $this->wire = $on;
        return $this;
    }

    /**
     * Example ->xmodel('debounce.500ms')
     */
    public function xmodel(string $on = 'x-model'): self
    {
        //handled in BaseBladeField->setDefaults()
        $this->xmodel = $on;
        return $this;
    }

    public function deferEntangle(bool $state = true): self
    {
        $this->deferEntangle = $state;
        return $this;
    }

}
