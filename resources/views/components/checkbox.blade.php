<div {{ $attributes->only('x-data') }} class="{{ $field->wrapperClass }}">
<input
    type="checkbox"
    @if($field->disabled) disabled @endif
    {{ $attributes->except([...array_keys($attr), 'x-data', 'disabled', 'type'])->merge($attr)->merge(['class' => $field->class ]) }}
    />
    <div class="{{ $field->labelWrapperClass }}">
        <label for="{{ $field->id }}" class="{{ $field->checkboxLabelClass }}">
            {{ $label }}
        </label>
    </div>
</div>
