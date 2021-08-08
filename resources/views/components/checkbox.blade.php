<div {{ $attributes->only('x-data') }} class="{{ $wrapperClass }}">
<input
    type="checkbox"
    id="{{ $id }}"
    name="{{ $name }}"
    {{ $attributes->except([...array_keys($attr), 'id', 'name', 'x-data'])->merge($attr)->merge(['class' => $class ]) }}
    />
    <div class="{{ $labelWrapperClass }}">
        <label for="{{ $id }}" class="{{ $labelClass }}">
            {{ $label }}
        </label>
    </div>
</div>
