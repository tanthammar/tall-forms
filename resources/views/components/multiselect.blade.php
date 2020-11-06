<div x-data="{ open: false}">
    <div class="form-select" x-on:click="open = ! open">
        {{ $field->placeholder ?? 'Select an option ...' }}
    </div>
    <select x-show="open" x-on:click.away.stop="open = false" multiple @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach>
        @forelse($field->options as $value => $label)
            <option wire:key="{{ md5($temp_key.$value) }}" value="{{ $value }}">{{ $label }}</option>
        @empty
            <option value="" disabled>...</option>
        @endforelse
    </select>
</div>
