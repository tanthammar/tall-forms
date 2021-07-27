<x-tall-input-array
    :field="[
        'id' => $field->getHtmlId($_instance->id),
        'key' => $field->key,
        'deferEntangle' => $field->deferEntangle,
        'type' => $field->input_type,
        'wrapperClass' => $field->wrapperClass,
        'class' => $field->class,
        'placeholder' => $field->placeholder,
        'errorMsg' => $field->errorMsg,
        'maxItems' => $field->maxItems, //0 = unlimited
        'minItems' => $field->minItems, //0 = unlimited
    ]"
    :attr="$field->getAttr('input')"/>
