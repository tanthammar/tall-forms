<?php


namespace Tanthammar\TallForms\Traits;


trait HasSharedProperties
{
    public null|string $livewireComponent = null;
    public array $livewireParams = [];
    public bool $is_custom = false;
    public bool $is_relation = false;
    public bool $has_array_value = false;
    public bool $rules_apply_to_each_item = false; //These field types applies rules() to each item, DON'T add to checkboxes or multiselect. They use Rule::in([...]) validation.

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
