<x-tall-file-upload
    :field="(object)[
        'multiple' => $field->multiple,
        'name' => $field->name,
        'class' => $field->class,
        'confirm_delete' => $field->confirm_delete,
        'confirm_msg' => $field->confirm_msg,
        'accept' => $field->accept,
     ]"
    :show-file-upload-error="$showFileUploadError"
    :show-file-upload-error-for="$showFileUploadErrorFor"
    :field-value="${$field->name}" />
