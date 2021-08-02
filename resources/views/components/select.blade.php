<select
    name="{{ $field->name }}"
    id="{{ $field->id }}"
    @if($value) value="{{ $value }}" @endif
    {{ $attributes->except(['id', 'name'])->merge($attr)->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }}
>
@if($field->placeholder) <option value="">{{ $field->placeholder }}</option> @endif
@forelse($options as $value => $label)
<option wire:key="id{{ md5($field->id.$field->key.$value) }}" value="{{ $value }}">{{ $label }}</option>
@empty
<option value="" disabled>...</option>
@endforelse
</select>
