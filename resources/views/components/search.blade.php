<div x-data="{ optionsVisible: false }">
    <input
        wire:model.debounce.{{ $field->debounce }}="{{ $field->searchKey }}"
        class="form-input"
        placeholder="{{ $field->placeholder }}"
        x-on:click="optionsVisible = true"
        x-on:click.away="optionsVisible = false" />

    <input
        wire:model="{{ $temp_key }}"
        x-ref="selected"
        class="form-input" />
    <ul>
        @foreach($options as $key => $value)
            <li x-on:click="$refs.selected.value = '{{ $key }}'; optionsVisible = false;">{{ $value }}</li>
        @endforeach
    </ul>

</div>
