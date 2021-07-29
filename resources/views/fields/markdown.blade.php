<x-tall-markdown
    :field="[
        'id' => $field->getHtmlId($_instance->id),
        'key' => $field->key,
        'deferEntangle' => $field->deferEntangle,
        'placeholder' => $field->placeholder,
        'wrapperClass' => $field->wrapperClass,
        'includeScript' => $field->includeScript,
        'wrapperClass' => $field->wrapperClass,
    ]"
    :options="$field->options"
    :attr="$field->getAttr('input')"
>{{ data_get($this, $field->key) }}</x-tall-markdown>
