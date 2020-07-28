<x-tall-field-wrapper :inline="$field->inline" :colspan="$field->colspan" :field="$field->name" :label="$field->label"
    :labelW="$field->labelW" :fieldW="$field->fieldW">
    <x-tall-checkbox :field="$field->key" :id="$field->name"
        :label="$field->placeholder" :help="$field->help" :errorMsg="$field->errorMsg" />
</x-tall-field-wrapper>
