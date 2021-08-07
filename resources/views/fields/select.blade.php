<x-tall-select
    :field="[
        'id' => $field->makeHtmlId($_instance->id),
        'name' => $field->name,
        'key' => $field->key, //@error & Livewire prop
        'class' => $field->class ?? $field->wrapperClass,
        'placeholder' => $field->placeholder,
        'multiple' => false,
    ]"
    :value="data_get($this, $field->key)"
    :options="$field->options"
    :attr="array_merge([
        $field->wire => $field->key
    ], $field->getAttr('input'))"
/>
