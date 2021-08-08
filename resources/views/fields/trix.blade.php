<x-tall-trix
    :field="$field->mergeBladeDefaults($_instance->id, [
        'value' => data_get($this, $field->key),
        'allowAttachments' => $field->allowAttachments,
        'includeScript' => $field->includeScript,
        'attachmentKey' => $field->attachmentKey,
        'allowedMimeTypes' => $field->allowedMimeTypes,
        'maxAttachments' => $field->maxAttachments,
        'maxKB' => $field->maxKB,
    ])"
/>
