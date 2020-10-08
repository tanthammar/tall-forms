<div x-data="{
    optionsVisible: false,
    field: @entangle($temp_key),
    selected: null,
    searchInput: @entangle($field->searchKey)}
">
    <p class="form-input">{{data_get($this, $temp_key)}}</p>
    <p class="form-select">{{data_get($this, $field->searchKey)}}</p>
    <x-tall-search
        :field="$field"
        :temp-key="$temp_key"
        :options="${$field->optionsKey}"
    />
</div>

