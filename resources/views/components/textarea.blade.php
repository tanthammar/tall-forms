<textarea
    @if($field->required) required @endif
    {{ $attributes->except(array_keys($attr))->merge($attr)->merge(['class' => $errors->has($field->key) ? $field->errorClass : $field->class ]) }}>
</textarea>
