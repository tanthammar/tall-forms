<div class="tf-keyval-root">
    <div class="{{ $field->array_wrapper_class ?? 'tf-keyval-wrapper' }}">
        <div class="{{ $field->array_wrapper_grid_class ?? 'tf-keyval-wrapper-grid' }}">
            @foreach($field->fields as $nested_field)
                @php
                    $nested_field->inline = $nested_field->inline ?? $field->childInline;
                    $nested_field->colspan = $field->childCols ?? $nested_field->colspan;
                    $nested_field->inArray = true;
                    $nested_field->wire = filled($field->wire) ? $field->wire : $nested_field->wire;
                @endphp
                @include('tall-forms::includes.field-root', ['field' => $nested_field])
            @endforeach
        </div>
    </div>
</div>
{{-- after field --}}
@include('tall-forms::includes.below')
