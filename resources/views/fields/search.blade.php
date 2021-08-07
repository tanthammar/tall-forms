<x-tall-search
    :field="$field->mergeBladeDefaults($_instance->id, [
            'searchKey' => $field->searchKey,
            'debounce' => $field->debounce,
            'listWidth' => $field->listWidth,
            'placeholder' => $field->placeholder,
        ])"
    :options="$field->options"
/>

