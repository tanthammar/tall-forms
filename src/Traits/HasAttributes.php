<?php


namespace Tanthammar\TallForms\Traits;


trait HasAttributes
{
    public static array $attributes = [];

    public $xData;
    public $xInit;
    public $wire = 'wire:model.lazy';

    public static function __constructStatic()
    {
        static::$attributes = config('tall-forms.field-attributes');
        static::$attributes['input'] = [];
    }

    public function getAttr($type)
    {
        return data_get(static::$attributes, $type, []);
    }

//    public function setAttr()
//    {
//        static::$attributes = config('tall-forms.field-attributes');
//        data_set(static::$attributes, 'input', []);
//    }

    public function rootAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge(static::$attributes['root'], $attributes) : static::$attributes['root'] = $attributes;
        return $this;
    }

    public function labelAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge(static::$attributes['label'], $attributes) : static::$attributes['label'] = $attributes;
        return $this;
    }

    public function afterLabelAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge(static::$attributes['after-label'], $attributes) : static::$attributes['after-label'] = $attributes;
        return $this;
    }

    public function aboveAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge(static::$attributes['above'], $attributes) : static::$attributes['above'] = $attributes;
        return $this;
    }

    public function belowWrapperAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge(static::$attributes['below-wrapper'], $attributes) : static::$attributes['below-wrapper'] = $attributes;
        return $this;
    }

    public function belowAttr(array $attributes, bool $merge = true): self
    {
        $merge ? array_merge(static::$attributes['below'], $attributes) : static::$attributes['below'] = $attributes;
        return $this;
    }

    // don't know if I should use this yet
//    public function inputWrapperAttr(array $attributes, bool $merge = true): self
//    {
//        $merge ? array_merge(static::$attributes['input-wrapper'], $attributes) : static::$attributes['input-wrapper'] = $attributes;
//        return $this;
//    }

    public function inputAttr(array $attributes): self
    {
        static::$attributes['input'] = $attributes;
        return $this;
    }

    public function wire(string $wire_model_declaration): self
    {
        $this->wire = $wire_model_declaration;
        return $this;
    }
}
