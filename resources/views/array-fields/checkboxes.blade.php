<div class="col-span-{{ $array_field->colspan ?? 6 }}">
    @foreach($array_field->options as $value => $label)
    <x-tall-checkbox :colspan="$array_field->colspan ?? 6" :field="$temp_key"
        id="{{ $temp_key }}.{{ $loop->index }}" :label="$label" :value="$value"
        :help="$array_field->help" :errorMsg="$array_field->errorMsg"/>
    @endforeach
</div>
