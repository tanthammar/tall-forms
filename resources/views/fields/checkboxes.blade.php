<x-tall-field-wrapper align="items-start" :inline="$field->inline ?? $inline" :field="$field->name" :label="$field->label" :labelSuffix="$field->labelSuffix" :labelW="$field->labelW" :fieldW="$field->fieldW">
    @foreach($field->options as $value => $label)
        <x-tall-checkbox field="{{$field->key}}" id="{{$field->name}}.{{$loop->index}}" :label="$label" :help="$field->help" :errorMsg="$field->errorMsg" :value="$value" />
    @endforeach
</x-tall-field-wrapper>
