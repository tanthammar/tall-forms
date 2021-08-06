<x-tall-range
    :field="$field->mergeBladeDefaults($_instance->id, [
        'min' => $field->min,
        'max' => $field->max,
        'step' => $field->step,
        'class' => 'flex-1 w-full ' . $field->class
    ])"
    :attr="$field->getAttr('input')"
/>
