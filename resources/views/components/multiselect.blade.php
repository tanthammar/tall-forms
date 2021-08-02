<div x-data="{ open: false, field: {{ json_encode($value) }} }">
    <div x-cloak
         x-show="!field.length"
         type="text"
         class="form-select my-1"
         x-on:click="open = ! open">
        {{ $field->placeholder }}
    </div>
    <select x-cloak
            x-show="open || field.length"
            x-model="field"
            class="form-multiselect"
            x-on:click.outside.stop="open = false"
            multiple
            name="{{ $field->name }}"
            id="{{ $field->id }}"
            {{ $attributes->except(['id', 'name', 'value'])->merge($attr)->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }}>
        @forelse($options as $value => $label)
            <option class="p-2" wire:key="id{{ md5($field->id.$field->key.$value) }}" value="{{ $value }}">{{ $label }}</option>
        @empty
            <option class="p-2" value="" disabled>...</option>
        @endforelse
    </select>
</div>
