<x-tall-field-wrapper :inline="$field->inline ?? $inline" :field="$field->name" :label="$field->label" :labelW="$field->labelW" :fieldW="$field->fieldW">
        @livewire('tall-tags', [
            'model' => $model,
            'tagType' => $field->tagType,
            'field' => $field->name,
            'tags' => data_get($form_data, $field->name),
            'help' =>$field->help,
            'errorMsg' => $field->errorMsg
        ])
</x-tall-field-wrapper>
