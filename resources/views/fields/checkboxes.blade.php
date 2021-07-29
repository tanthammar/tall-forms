@php $alpineKey = $field->alpineKey ?? 'checkboxes'; @endphp
<x-tall-checkboxes
    :id="$field->getHtmlId($_instance->id)"
    :name="$field->name"
    :options="$field->options"
    :wrapper-class="$field->wrapperClass"
    :label-class="$field->checkboxLabelClass"
    :class="$field->class"
    x-data="{ {{ $alpineKey }}: $wire.entangle('{{ $field->key }}'){{ $field->deferString }} }"
    :attr="array_merge([
        $field->xmodel => $alpineKey
    ], $field->getAttr('input'))"
/>

