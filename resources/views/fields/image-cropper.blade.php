<x-tall-image-cropper :field="[
    'width' => $field->width,
    'height' => $field->height,
    'shape' => $field->shape,
    'key' => $field->key,
    'name' => $field->name,
    'dropZoneHelp' => $field->dropZoneHelp,
    'fileInfo' => $field->fileInfo,
    'wrapperClass' => $field->wrapperClass,
    'uploadButton' => $field->uploadButton,
    'thumbnail' => $field->thumbnail,
    'includeScript' => $field->includeScript,
    'imageUrl' => data_get($this, $field->key),
]"/>
