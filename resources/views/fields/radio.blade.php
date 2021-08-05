@php $alpineKey = $field->alpineKey ?? 'radio'; @endphp
<x-tall-radio :field="[
        'id' => $field->getHtmlId($_instance->id),
        'name' => $field->name,
        'key' => $field->key,
        'class' => $field->class, //div wrapping input & label
        'wrapperClass' => $field->wrapperClass, //outmost div
    ]"
    :options="$field->options"
    x-data="{ {{ $alpineKey }}: $wire.entangle('{{ $field->key }}'){{ $field->deferString }} }"
    :attr="array_merge([
        $field->xmodel => $alpineKey
    ], $field->getAttr('input'))"
/>
