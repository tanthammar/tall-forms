<?php


namespace Tanthammar\TallForms\Traits;


trait HasSharedProperties
{
    public $livewireComponent;
    public $livewireParams;
    public $is_custom = false;

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
}
