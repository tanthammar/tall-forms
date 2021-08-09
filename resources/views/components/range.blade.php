<div x-data="{ range: $wire.entangle('{{ $field->key }}'){{ $field->deferString }} }" class="{{ $field->wrapperClass }}">
    <div class="tf-range-wrapper" x-cloak>
        <div class="tf-range-value" x-text="range"></div>
        <div class="tf-range-labels">{{ $field->min }}</div>
        <input
            x-model="range"
            {{ $attributes->except([...array_keys($attr), 'x-data'])->whereDoesntStartWith('x-model')->merge($attr)->merge([ 'class' => $field->class ]) }}
        />
        <div class="tf-range-labels">{{ $field->max }}</div>
    </div>
</div>
