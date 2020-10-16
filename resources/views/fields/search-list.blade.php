<div x-data="{
    optionsVisible: false,
    field: @entangle($temp_key),
    selected: null,
    searchInput: @entangle($field->searchKey)}
">
    <x-tall-search-list
        :field="$field"
        :temp-key="$temp_key"
        :options="${$field->optionsKey}"
    />
</div>

