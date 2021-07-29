<x-tall-image-cropper :field="[
    'id' => $field->getHtmlId($_instance->id), //id falls back to name
    'key' => $field->key,
    'name' => $field->name,
    'width' => $field->width,
    'height' => $field->height,
    'shape' => $field->shape,
    'dropZoneHelp' => $field->dropZoneHelp,
    'fileInfo' => $field->fileInfo,
    'wrapperClass' => $field->wrapperClass,
    'uploadButton' => $field->uploadButton,
    'thumbnail' => $field->thumbnail,
    'includeScript' => $field->includeScript,
    'imageUrl' => data_get($this, $field->key),
]"/>
