<div class="w-full mt-2">
    @php $keyval = $field @endphp
    <div class="flex flex-col divide-y mb-2 {{ $keyval->array_wrapper_class }}">
        <div class="py-2">
            <div class="flex px-2 space-x-3">
                <div class="flex-1 sm:grid sm:grid-cols-12 col-gap-2 row-gap-4">
                    @foreach($keyval->fields as $array_field)
                        @php
                            $temp_key = "{$keyval->key}.{$array_field->name}";
                        @endphp
                        @include('tall-forms::includes.field-root', ['field' => $array_field])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
