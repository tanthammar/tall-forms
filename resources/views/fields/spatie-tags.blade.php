<livewire:tall-spatie-tags
    :model="$model"
    :field="$field->fieldToArray()"
    :tags="data_get($form_data, $field->name, '')"
/>
