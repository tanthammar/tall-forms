<x-tall-input-array
    :field="$field->mergeBladeDefaults($_instance->id, [
        'type' => $field->input_type,
        'placeholder' => $field->placeholder,
        'errorMsg' => $field->errorMsg,
        'maxItems' => $field->maxItems, //0 = unlimited
        'minItems' => $field->minItems, //0 = unlimited
    ])"
    :attr="$field->getAttr('input')"/>
