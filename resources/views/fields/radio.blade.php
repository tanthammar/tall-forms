@foreach($field->options as $value => $label)
    <x-tall-radio
        :field="$field"
        :temp-key="$temp_key"
        :value="$value"
        :label="$label"
        :options-idx="$field->name.$loop->index" />
@endforeach
