<textarea
    value="{{ old($field->key) }}"
    @if($required) required @endif
    @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    {{ $attributes->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }}>
</textarea>
