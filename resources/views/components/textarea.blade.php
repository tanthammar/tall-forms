<textarea
    value="{{ old($temp_key) }}"
    @if($required) required @endif
    @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    {{ $attributes->merge(['class' => $errors->has($temp_key) ? $error() : $class() ]) }}>
</textarea>
