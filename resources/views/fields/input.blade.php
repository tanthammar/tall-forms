@if($field->input_type === 'hidden')
    <input x-ref="{{ $field->key }}" wire:model.lazy="{{ $field->key }}" name="{{ $field->key }}" type="hidden"/>
@else
<x-tall-field-wrapper :inline="$field->inline" :colspan="$field->colspan" :field="$field->name" :label="$field->label" :labelW="$field->labelW" :fieldW="$field->fieldW">
    <x-tall-input :field="$field->key" :id="$field->name" :type="$field->input_type" :prefix="$field->prefix" :icon="$field->icon" :fieldClass="$field->class" :autocomplete="$field->autocomplete" :placeholder="$field->placeholder" :help="$field->help" :errorMsg="$field->errorMsg" />
</x-tall-field-wrapper>
@endif
