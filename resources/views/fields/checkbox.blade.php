@php $alpineKey = $field->alpineKey ?? 'checkbox'; @endphp
<x-tall-checkbox
    :id="$field->getHtmlId($_instance->id)"
    :name="$field->name"
    :label="$field->placeholder ?? $field->label ?? ''"
    :wrapper-class="$field->wrapperClass"
    :label-class="$field->checkboxLabelClass"
    :class="$field->class"
    x-data="{ {{ $alpineKey }}: $wire.entangle('{{ $field->key }}'){{ $field->deferString }} }"
    :attr="array_merge([
        $field->xmodel => $alpineKey
    ], $field->getAttr('input'))"
/>
