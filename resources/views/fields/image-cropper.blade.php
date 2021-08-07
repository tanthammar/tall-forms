<x-tall-image-cropper :field="$field->mergeBladeDefaults($_instance->id, [
    'width' => $field->width,
    'height' => $field->height,
    'shape' => $field->shape,
    'dropZoneHelp' => $field->dropZoneHelp,
    'fileInfo' => $field->fileInfo,
    'uploadButton' => $field->uploadButton,
    'thumbnail' => $field->thumbnail,
    'includeScript' => $field->includeScript,
    'imageUrl' => data_get($this, $field->key),
])"/>
