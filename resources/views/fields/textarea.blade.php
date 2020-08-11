<x-tall-field-wrapper :inline="$field->inline" :field="$field->name" :label="$field->label" :labelW="$field->labelW" :fieldW="$field->fieldW">
    <x-tall-textarea
    :field="$field->key"
    :id="$field->name"
    :rows="$field->textarea_rows"
    :fieldClass="$field->class"
    :placeholder="$field->placeholder"
    :help="$field->help"
    :errorMsg="$field->errorMsg" />
</x-tall-field-wrapper>
