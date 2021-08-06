<div x-data="{ range: $wire.entangle('{{ $field->key }}'){{ $field->deferString }} }" class="{{ $field->wrapperClass }}">
    <div class="tf-range-wrapper" x-cloak>
        <div class="tf-range-value" x-text="range"></div>
        <div class="tf-range-labels">{{$field->min}}</div>
        <input
            id="{{ $field->id }}" name="{{ $field->name }}" type="range"
            min="{{ $field->min }}" max="{{ $field->max }}" step="{{ $field->step }}"
            x-model="range"
            {{ $attributes->except(['x-data', 'x-model', 'id', 'name', 'type', 'min', 'max', 'step'])->merge($attr)->merge([ 'class' => $field->class ]) }}
        />
        <div class="tf-range-labels">{{ $field->max }}</div>
    </div>
</div>
