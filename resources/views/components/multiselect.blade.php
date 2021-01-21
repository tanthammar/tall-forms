<div x-data="{ open: false, field: {{ json_encode($value) }} }">
    <div x-cloak x-show="!field.length" type="text" class="form-select my-1" x-on:click="open = ! open">
        {{ $field->placeholder ?? 'Select an option ...' }}
    </div>
    <select x-cloak x-show="open || field.length" x-model="field" class="form-multiselect" x-on:click.away.stop="open = false" multiple @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach>
        @forelse($field->options as $value => $label)
            <option class="p-2" wire:key="{{ md5($field->key.$value) }}" value="{{ $value }}">{{ $label }}</option>
        @empty
            <option class="p-2" value="" disabled>...</option>
        @endforelse
    </select>
</div>
