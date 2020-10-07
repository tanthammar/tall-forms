<div x-data="{
    optionsVisible: false,
    searchValue: @entangle($temp_key),
    searchInput: @entangle($field->searchKey)}
">
    <input x-model="searchValue" type="hidden" />
    <x-tall-search
        :field="$field"
        :temp-key="$temp_key"
        :options="${$field->optionsKey}"
    />
</div>

