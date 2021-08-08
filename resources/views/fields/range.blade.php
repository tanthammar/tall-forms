<x-tall-range
    :field="$field->mergeBladeDefaults($_instance->id, [
        'min' => $field->min,
        'max' => $field->max,
        'step' => $field->step,
    ])"
    :attr="$field->getAttr('input')"
/>
