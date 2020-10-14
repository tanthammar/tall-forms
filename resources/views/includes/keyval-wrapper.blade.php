@php $keyval = $field @endphp
<div class="w-full">
    <div class="{{ $keyval->array_wrapper_class }}">
        <div class="{{ $keyval->array_wrapper_grid_class }}">
            @foreach($keyval->fields as $array_field)
                @php
                    $temp_key = "{$parent_name}.{$array_field->name}";
                    $array_field->inline = $array_field->inline ?? false;
                    $array_field->inArray = true;
                @endphp
                @include('tall-forms::includes.field-root', ['field' => $array_field])
            @endforeach
        </div>
    </div>
</div>
{{-- after field --}}
@include('tall-forms::includes.below', ['temp_key' => $keyval->key ])
