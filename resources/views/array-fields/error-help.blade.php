@error($bind)
    <p class="error">{{ $message }}</p>
@elseif($array_field->help)
    <p class="help">{{ $array_field->help }}</p>
@enderror
