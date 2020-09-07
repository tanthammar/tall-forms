<input
    value="{{ old($temp_key) }}"
    @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    {{ $attributes->merge(['class' => $errors->has($temp_key) ? $error() : $class() ]) }}
/>
