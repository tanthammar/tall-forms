<?php


namespace Tanthammar\TallForms\Traits;


trait HasOptions
{
    use HandlesArrays;

    public $options = [];
    public $callableOptions;

    /**
     * Flat key => value based Array, Collection or Closure.
     * You can use a component method; ->options($this->someMethod())
     * OBSERVE: if you use a callable, it will be executed on EVERY re-render of the component!
     * Maybe you should consider setting the $options in mount() instead?
     * @param array|\Closure|\Illuminate\Support\Collection $options
     * @param bool $flip_key_value
     * @return $this
     */
    public function options($options, $flip_key_value = true): self
    {
        if (is_callable($options)) $options = $options();

        if ($options instanceof \Illuminate\Support\Collection) $options = $options->toArray();

        $flip_key_value ? $this->arrayFlipOrCombine($options) : $this->options = $options;
        return $this;
    }

    /**
     * The callable should return a flat key => value array.
     * OBSERVE: that this call will be executed on EVERY re-render of the component!
     * Maybe you should consider using the options() method and set the property in mount() instead
     * @param callable $callable
     * @return $this
     * @deprecated use options($options) instead
     */
    public function callableOptions(callable $callable): self
    {
        $options = is_callable($callable) ? app()->call($callable) : [];
        $this->arrayFlipOrCombine($options);
        return $this;
    }

}
