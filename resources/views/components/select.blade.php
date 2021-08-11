<select {{ $attributes->except(array_keys($attr))->merge($attr)->merge(['class' => $errors->has($field->key) ? $field->errorClass : $field->class ]) }}>
@if($field->placeholder) <option value="">{{ $field->placeholder }}</option> @endif
@forelse($field->options as $value => $label)
<option wire:key="id{{ md5($field->id.$field->key.$value) }}" value="{{ $value }}">{{ $label }}</option>
@empty
<option value="" disabled>...</option>
@endforelse
</select>
