<?php


namespace Tanthammar\TallForms\Traits;


use Illuminate\Support\Arr;

trait HasAttributes
{
    public array $attributes = [];

    public null|string $wire = null; // default = wire:model.lazy, in config/tall-forms, set in BaseField __construct()
    public null|string|bool $defer = null;
    public null|string|bool $lazy = null;

    public function getAttr($type): mixed
    {
        return data_get($this->attributes, $type, []);
    }

    public function setAttr(): void
    {
        $this->attributes = config('tall-forms.field-attributes');
        data_set($this->attributes, 'input', []);
    }

    public function setBinding(string $text): void
    {
        //used in BaseField __construct(), wire(), bind(), see below
        if (str_contains($text, 'defer')) $this->defer = true;
        if (str_contains($text, 'lazy')) $this->lazy = true;
        if (str_contains($text, 'debounce')) {
            $this->lazy = false;
            $this->defer = false;
        };
        $this->wire = $text;
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
     * @deprecated v8, use bind() without "wire.model." instead
     * <br>this value will be used for either wire.model or x-model depending on the field
     */
    public function wire(string $on): self
    {
        $this->setBinding(str_replace("wire.model", null, $on)); //legacy v7
        return $this;
    }

    /**
     * Used for both wire.model and x-model depending on the field.
     * <br>Observe: wire.model doesn't have a throttle attribute, x-model does.
     * <br>Example:
     * <br>'defer'
     * <br>'lazy'
     * <br>'debounce.750ms'
     * <br>'throttle.500ms' -> alpine fields only
     */
    public function bind(string $on): self
    {
        $this->setBinding($on);
        return $this;
    }

}
