<div class="{{$field->class}}">
    @if($field->prefix || $field->icon)
        <span class="{{ $icon_span }}">
            @if($field->icon)
                <span class="mx-1">@svg($field->icon, 'h-4 w-4')</span>
            @endif
            @if($field->prefix)
                <span class="mx-1">{{ $field->prefix }}</span>
            @endif
        </span>
    @endif
    <input
        value="{{ old($temp_key) }}"
        @if($required) required @endif
        @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
        {{ $attributes->merge(['class' => $errors->has($temp_key) ? $error() : $class() ]) }}
    />
    @error($temp_key)
    <x-tall-error-icon
        :right="in_array($field->input_type, ['date', 'datetime-local', 'time']) ? 'right-6' : 'right-0'"/>
    @enderror
</div>
