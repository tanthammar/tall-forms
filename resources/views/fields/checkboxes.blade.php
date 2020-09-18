@foreach($field->options as $label => $value)
        <x-tall-checkboxes
            :field="$field"
            :temp-key="$temp_key"
            :value="$value"
            :label="$label"
            :options-idx="$field->name.$loop->index" />
    @endforeach
