<x-tall-checkboxes
    :field="$field->mergeBladeDefaults($_instance->id, [
        'labelClass' => $field->checkboxLabelClass,
    ])"
    :options="$field->options"
    :attr="$field->getAttr('input')"
/>

