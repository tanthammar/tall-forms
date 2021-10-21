<?php


namespace Tanthammar\TallForms\Traits;


trait HasSharedProperties
{
    public null|string $livewireComponent = null;
    public array $livewireParams = [];
    public bool $is_custom = false;
    public bool $is_relation = false;

    public function livewireComponent(string $component, array $params = []): self
    {
        $this->livewireComponent = $component;
        $this->livewireParams = $params;
        return $this;
    }

    public function custom(): self
    {
        $this->is_custom = true;
        return $this;
    }

    public function relation(): self
    {
        $this->is_relation = true;
        return $this;
    }
}
