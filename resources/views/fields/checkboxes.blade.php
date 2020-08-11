<x-tall-field-wrapper :inline="$field->inline" :field="$field->name" :label="$field->label" :labelW="$field->labelW" :fieldW="$field->fieldW">
    @foreach($field->options as $value => $label)
        <x-tall-checkbox field="{{$field->key}}" id="{{$field->name}}.{{$loop->index}}" :label="$label" :help="$field->help" :errorMsg="$field->errorMsg" :value="$value" />
    @endforeach
</x-tall-field-wrapper>
