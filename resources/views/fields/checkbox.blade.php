<x-tall-checkbox
    :wireModel="$field->key"
    :wrapperClass="$field->class ?? ''"
    :deferEntangle="$field->deferEntangle"
    :label="$field->placeholder ?? $field->label ?? ''"
    :attr="$field->getAttr('input')"
/>
