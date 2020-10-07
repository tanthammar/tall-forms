<div>

    <input
        x-model.debounce.{{ $field->debounce }}="searchInput"
        class="form-input w-full"
        placeholder="{{ $field->placeholder }}"
        x-on:click="optionsVisible = true"
        x-on:click.away="optionsVisible = false" />

    <ul x-show="optionsVisible">
        @foreach($options as $key => $value)
            <li x-on:click="
                searchValue = '{{ $key }}';
                optionsVisible = false;
                searchInput = searchValue;
            ">{{ $value }}</li>
        @endforeach
    </ul>

</div>
