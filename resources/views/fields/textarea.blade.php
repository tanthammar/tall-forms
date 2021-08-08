<x-tall-textarea
    :field="$field->mergeBladeDefaults($_instance->id, [
        'required' => $field->required,
        'placeholder' => $field->placeholder,
        'rows' => $field->textarea_rows,
    ])"
    :attr="array_merge([
        $field->wire => $field->key
    ], $field->getAttr('input'))"
/>
