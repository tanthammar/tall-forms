@foreach($field->options as $value => $label)
        <x-tall-checkboxes
            :field="$field"
            :temp-key="$temp_key"
            :value="$value"
            :label="$label"
            wire:key="{{ md5($value.$label.$loop->index) }}" />
@endforeach
