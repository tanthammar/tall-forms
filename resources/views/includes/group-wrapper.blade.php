<div class="tf-group-root">
    <div class="{{ $field->array_wrapper_class ?? 'tf-group-wrapper' }}">
        <div class="{{ $field->array_wrapper_grid_class ?? 'tf-group-wrapper-grid' }}">
            @foreach($field->fields as $nested_field)
                @php
                    $nested_field->inline = $nested_field->inline ?? false;
                    $nested_field->inArray = true;
                @endphp
                @include('tall-forms::includes.field-root', ['field' => $nested_field])
            @endforeach
        </div>
    </div>
</div>
{{-- after field --}}
@include('tall-forms::includes.below')
