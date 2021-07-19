<x-tall-checkbox
    :id="$field->getHtmlId($_instance->id)"
    :label="$field->placeholder ?? $field->label ?? ''"
    :wrapper-class="$field->wrapperClass"
    :label-class="$field->checkboxLabelClass"
    :class="$field->class"
    value="{{ old($field->key) }}"
    x-data="{ {{ $field->alpineKey ?? 'checkbox' }}: $wire.entangle('{{ $field->key }}'){{ $field->deferString }} }"
    :attr="array_merge([
        $field->xmodel => $field->alpineKey ?? 'checkbox'
    ], $field->getAttr('input'))"
/>
