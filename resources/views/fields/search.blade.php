<div x-data="{
    optionsVisible: false,
    field: @entangle($field->key),
    selected: null,
    searchInput: @entangle($field->searchKey)}
">
    <x-tall-search
        :field="$field"
        :options="$field->options"
    />
</div>

