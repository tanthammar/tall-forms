<div x-data="{
    open: false,
    field: $wire.entangle('{{ $field->key }}'){{ $field->deferString }} }
">
    <div x-cloak
         x-show="!field.length"
         type="text"
         class="form-select my-1"
         x-on:click="open = !open">
        {{ $field->placeholder }}
    </div>
    <select x-cloak
            x-show="open || field.length"
            x-model="field"
            x-on:click.outside.stop="open = false"
            multiple
            {{ $attributes->except(array_keys($attr))->whereDoesntStartWith('x-model')->merge($attr)->merge(['class' => $errors->has($field->key) ? $field->errorClass : $field->class ]) }}>
        @forelse($field->options as $value => $label)
            <option class="p-2" wire:key="id{{ md5($field->id.$field->key.$value) }}" value="{{ $value }}">{{ $label }}</option>
        @empty
            <option class="p-2" value="" disabled>...</option>
        @endforelse
    </select>
</div>
