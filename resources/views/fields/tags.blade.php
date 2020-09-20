@livewire('tall-spatie-tags', [
    'model' => isset($model) && $model->exists ? $model : null,
    'tagType' => $field->tagType,
    'field' => $field->name,
    'tags' => data_get($form_data, $field->name),
    'help' =>$field->help,
    'errorMsg' => $field->errorMsg,
    'tagLocale' => $field->tagLocale,
    'errorClass' => $this->getAttr('error'),
    'helpClass' => $this->getAttr('help'),
    'color' => $this->getAttr('tags-color'),
])
