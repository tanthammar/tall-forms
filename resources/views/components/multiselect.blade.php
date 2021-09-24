<div x-data="{
    open: false,
    field: $wire.entangle('{{ $field->key }}'){{ $field->deferString }},
    }" x-cloak @if($field->wrapperClass) class="{{ $field->wrapperClass }}" @endif>
    <div x-show="!field.length"
         type="text"
         class="form-select my-1 cursor-pointer"
         x-on:click.stop="open = !open">
        {{ $field->placeholder }}
    </div>
    <div x-show="open || field.length" wire:key="wrap{{ md5($field->id.$field->key) }}">
        <select x-model="field"
                x-on:click.outside.stop="open = false"
                multiple
                @if($field->disabled) disabled @endif
                {{ $attributes->except([...array_keys($attr), 'disabled', 'multiple', 'class'])
                    ->whereDoesntStartWith('x-model')
                    ->merge($attr)
                    ->class([
                        $field->errorClass => $errors->has($field->key),
                        $field->class => !$errors->has($field->key)
                ]) }}>
            @forelse($field->options as $value => $label)
                <option class="p-2" wire:key="id{{ md5($field->id.$field->key.$value) }}" value="{{ $value }}">{{ $label }}</option>
            @empty
                <option class="p-2" value="" disabled>...</option>
            @endforelse
        </select>
    </div>
</div>
