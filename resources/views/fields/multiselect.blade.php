<x-tall-select
    :field="$field->mergeBladeDefaults($_instance->id, [
        'class' => $field->class ?? $field->wrapperClass,
        'placeholder' => $field->placeholder,
        'multiple' => true,
    ])"
    :value="data_get($this, $field->key, [])"
    :options="$field->options"
    :attr="array_merge([
        $field->wire => $field->key
    ], $field->getAttr('input'))"
/>
