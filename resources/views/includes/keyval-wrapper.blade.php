@php $keyval = $field @endphp
<div class="tall-forms-keyval-root">
    <div class="{{ $keyval->array_wrapper_class ?? 'tall-forms-keyval-wrapper' }}">
        <div class="{{ $keyval->array_wrapper_grid_class ?? 'tall-forms-keyval-wrapper-grid' }}">
            @foreach($keyval->fields as $array_field)
                @php
                    $temp_key = "{$keyval->key}.{$array_field->name}";
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
