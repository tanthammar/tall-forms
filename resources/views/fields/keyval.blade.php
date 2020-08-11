<x-tall-field-wrapper :inline="$field->inline" :field="$field->name" :label="$field->label" :labelW="$field->labelW" :fieldW="$field->fieldW">
@include('tall-forms::fields.error-help')
    <div class="w-full mt-2">
    <div class="flex flex-col divide-y mb-2 {{ $field->group_class }}">
            <div class="py-2">
                <div class="flex px-2 space-x-3">
                    <div class="flex-1 sm:grid sm:grid-cols-12 col-gap-2 row-gap-4">
                        @foreach($field->keyval_fields as $array_field)
                        @php $bind = "{$field->key}.{$array_field->name}" @endphp
                        @include('tall-forms::array-fields.' . $array_field->type)
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-tall-field-wrapper>
