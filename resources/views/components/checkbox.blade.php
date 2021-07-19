<div {{ $attributes->only('x-data') }} class="{{ $wrapperClass }}">
<input
    type="checkbox"
    id="{{ $id }}"
    name="{{ $id }}"
    {{ $attributes->except('x-data')->merge($attr)->merge(['class' => $class ]) }}
    />
    <div class="{{ $labelWrapperClass }}">
        <label for="{{ $id }}" class="{{ $labelClass }}">
            {{ $label }}
        </label>
    </div>
</div>
