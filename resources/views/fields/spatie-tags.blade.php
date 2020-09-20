@php
    $error = $this->getAttr('error');
    $help = $this->getAttr('help');
    $color = $this->getAttr('tags-color');
@endphp
<livewire:tall-spatie-tags
    :model="$model"
    :field="$field->name"
    :tag-type="$field->tagType"
    :tags="data_get($form_data, $field->name, '')"
    :help="$field->help"
    :errorMsg="$field->errorMsg"
    :tagLocale="$field->tagLocale"
    :errorClass="$error"
    :helpClass="$help"
    :color="$color"
/>
