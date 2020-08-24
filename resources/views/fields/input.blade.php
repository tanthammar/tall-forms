@if($field->input_type === 'hidden')
    <input x-ref="{{ $field->key }}" wire:model="{{ $field->key }}" name="{{ $field->key }}" type="hidden" autocomplete="{{ $field->autocomplete }}" class="nosy" />
@else
    <x-tall-field-wrapper :inline="$field->inline ?? $inline" :field="$field->name" :label="$field->label" :labelSuffix="$field->labelSuffix" :labelW="$field->labelW" :fieldW="$field->fieldW">
        <x-tall-input :field="$field->key" :id="$field->name" :type="$field->input_type" :prefix="$field->prefix" :icon="$field->icon" :fieldClass="$field->class" :autocomplete="$field->autocomplete" :placeholder="$field->placeholder" :help="$field->help" :errorMsg="$field->errorMsg" :step="$field->step" :min="$field->min" :max="$field->max"/>
    </x-tall-field-wrapper>
@endif
