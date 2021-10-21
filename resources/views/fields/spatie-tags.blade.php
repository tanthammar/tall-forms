<livewire:tall-spatie-tags
    :model="$model"
    :field="$field->fieldToArray()"
    :tags="data_get($this, $field->key, '')"
/>
