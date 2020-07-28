<div class="col-span-{{ $array_field->colspan ?? 6 }}">
    <div class="w-full my-2 flex items-center space-x-4">
        @foreach($array_field->options as $value => $label)
        <x-tall-radio :field="$bind" :label="$label"
            id="{{$bind}}.{{$loop->index}}" :value="$value" />
        @endforeach
    </div>
    @include('tall-forms::array-fields.error-help')
</div>