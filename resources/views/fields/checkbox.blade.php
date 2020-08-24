<x-tall-field-wrapper align="items-center" :inline="$field->inline ?? $inline" :field="$field->name" :label="$field->label" :labelSuffix="$field->labelSuffix" :labelW="$field->labelW" :fieldW="$field->fieldW">
    <x-tall-checkbox :field="$field->key" :id="$field->name"
        :label="$field->placeholder ?? $field->label" :help="$field->help" :errorMsg="$field->errorMsg" />
</x-tall-field-wrapper>
