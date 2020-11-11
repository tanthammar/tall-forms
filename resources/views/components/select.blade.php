<select @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach>
@if($field->placeholder) <option value="" disabled>{{ $field->placeholder }}</option> @endif
@foreach($field->options as $value => $label)
    <option wire:key="{{ md5($temp_key.$value) }}" value="{{ $value }}">{{ $label }}</option>
@endforeach
</select>
