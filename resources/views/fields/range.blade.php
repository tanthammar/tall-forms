<x-tall-field-wrapper :inline="$field->inline" :colspan="$field->colspan" :field="$field->name" :label="$field->label" :labelW="$field->labelW" :fieldW="$field->fieldW">
    <x-tall-range :field="$field->key" :id="$field->name" :fieldClass="$field->class" :help="$field->help" :errorMsg="$field->errorMsg" :step="$field->step" :min="$field->min" :max="$field->max"/>
</x-tall-field-wrapper>
