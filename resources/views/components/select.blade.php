<select @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
{{ $attributes->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }}
>
@if($field->placeholder) <option value="">{{ $field->placeholder }}</option> @endif
@forelse($field->options as $value => $label)
<option wire:key="{{ md5($field->key.$value) }}" value="{{ $value }}">{{ $label }}</option>
@empty
<option value="" disabled>...</option>
@endforelse
</select>
