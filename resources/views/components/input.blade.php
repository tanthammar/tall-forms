<input
    name="{{ $name }}"
    type="{{ $type }}"
    id="{{ $id }}"
    @if($value)value="{{ $value }}"@endif
    @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    {{ $attributes->merge(['class' => $errors->has($temp_key) ? $error() : $class() ]) }}
/>
