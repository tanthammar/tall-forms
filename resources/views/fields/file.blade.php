<x-tall-file-upload :field="[
        'multiple' => $field->multiple,
        'id' => $field->getHtmlId($_instance->id),
        'name' => $field->name, //field->key is not used as this field requires a separate livewire property, that is set in BaseField construct
        'class' => $field->class,
        'confirm_delete' => $field->confirm_delete,
        'confirm_msg' => $field->confirm_msg,
        'accept' => $field->accept,
        'errorMsg' => $field->errorMsg,
        'fieldValue' => ${$field->name},
     ]"
    {{-- these props updates in UploadsFiles trait if there are multiple file upload fields on the page --}}
    :show-file-upload-error="$showFileUploadError"
    :show-file-upload-error-for="$showFileUploadErrorFor"
/>
