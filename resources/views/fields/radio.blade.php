<x-tall-field-wrapper :inline="$field->inline" :colspan="$field->colspan" :field="$field->name" :label="$field->label"
    :labelW="$field->labelW" :fieldW="$field->fieldW">
    @foreach($field->options as $value => $label)
    <x-tall-radio :field="$field->key" :label="$label" id="{{$field->name}}.{{$loop->index}}" :value="$value" />
    @endforeach
    @include('tall-forms::fields.error-help')
</x-tall-field-wrapper>