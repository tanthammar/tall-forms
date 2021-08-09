<x-tall-select
    :field="$field->mergeBladeDefaults($_instance->id, [
        'class' => $field->class ?? $field->wrapperClass,
        'placeholder' => $field->placeholder,
        'multiple' => false,
    ])"
    :options="$field->options"
    :attr="array_merge([
        $field->wire => $field->key
    ], $field->getAttr('input'))"
/>
