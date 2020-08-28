<?php


namespace Tanthammar\TallForms\Traits;


trait HasAttributes
{
    public $attributes = [
        'root' => [],
        'label' => [],
        'wrapper' => [],
        'input' => [],
    ];

    public function getAttr($type)
    {
        return $attributes = data_get($this->attributes, $type, []);
    }

    public function rootAttr(array $attributes): self
    {
        $this->attributes['root'] = $attributes;
        return $this;
    }

    public function labelAttr(array $attributes): self
    {
        $this->attributes['label'] = $attributes;
        return $this;
    }

    public function wrapperAttr(array $attributes): self
    {
        $this->attributes['wrapper'] = $attributes;
        return $this;
    }

    public function inputAttr(array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }
}
