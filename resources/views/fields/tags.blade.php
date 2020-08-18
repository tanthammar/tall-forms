<x-tall-field-wrapper :inline="$field->inline ?? $inline" :field="$field->name" :label="$field->label" :labelW="$field->labelW" :fieldW="$field->fieldW">
    @if(filled($model))
        @livewire('tall-tags-update', [
            'model' => $model,
            'tagType' => $field->tagType,
            'field' => $field->name,
            'tags' => data_get($form_data, $field->name),
            'help' =>$field->help,
            'errorMsg' => $field->errorMsg
        ])
    @else
        @livewire('tall-tags-create', [
            'tagType' => $field->tagType,
            'field' => $field->name,
            'tags' => data_get($form_data, $field->name),
            'help' =>$field->help,
            'errorMsg' => $field->errorMsg
        ])
    @endif
</x-tall-field-wrapper>
