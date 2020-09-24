<select @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach>
@if($field->placeholder) <option value="">{{ $field->placeholder }}</option> @endif
@foreach($field->options as $value => $label)
    <option value="{{ $value }}">{{ $label }}</option>
@endforeach
</select>
