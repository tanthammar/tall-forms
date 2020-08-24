<x-tall-field-wrapper align="items-start" :inline="$field->inline ?? $inline" :field="$field->name" :label="$field->label" :labelSuffix="$field->labelSuffix" :labelW="$field->labelW" :fieldW="$field->fieldW">
    @foreach($field->options as $value => $label)
    <x-tall-radio :field="$field->key" :label="$label" id="{{$field->name}}.{{$loop->index}}" :value="$value" />
    @endforeach
    @include('tall-forms::fields.error-help')
</x-tall-field-wrapper>
