<div x-data="{ inputArray: @entangle($this->field->key) }">
    <input
        type="number"
    @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    {{ $attributes->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }} />
</div>
