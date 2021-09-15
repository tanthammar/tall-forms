<textarea
    @if($field->required) required @endif
    @if($field->disabled) disabled @endif
    {{ $attributes->except([...array_keys($attr), 'required', 'disabled'])->merge($attr)->merge(['class' => $errors->has($field->key) ? $field->errorClass : $field->class ]) }}>
</textarea>
