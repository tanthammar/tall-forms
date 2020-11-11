<div x-data="{ open: false, isSelected: @json($is_selected) }">
    <div x-show="!isSelected" class="form-select" x-on:click="open = ! open">
        <span>@json($is_selected)</span> {{ $field->placeholder ?? 'Select an option ...' }} <span x-text="isSelected"></span>
    </div>
    <select x-cloak x-show="open || isSelected" x-on:click.away.stop="open = false" multiple @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach>
        @forelse($field->options as $value => $label)
            <option wire:key="{{ md5($temp_key.$value) }}" value="{{ $value }}">{{ $label }}</option>
        @empty
            <option value="" disabled>...</option>
        @endforelse
    </select>
</div>
