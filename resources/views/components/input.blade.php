<div class="{{$field->class}}">
    @if($field->prefix || $field->hasIcon)
        <span class="{{ $icon_span }}">
            @if($field->icon)
                <span class="mx-1">@svg($field->icon, 'h-4 w-4')</span>
            @endif
            @if($field->tallIcon)
                <span class="mx-1"><x-tall-svg :path="$field->tallIcon" class="h-4 w-4" /></span>
            @endif
            @if($field->htmlIcon)
                <span class="mx-1">{!! $field->htmlIcon !!}</span>
            @endif
            @if($field->prefix)
                <span class="mx-1 whitespace-no-wrap">{{ $field->prefix }}</span>
            @endif
        </span>
    @endif
    <input
        value="{{ old($field->key) }}"
        @if($required) required @endif
        @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
        {{ $attributes->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }}
    />
    @error($field->key)
    <x-tall-error-icon
        :right="in_array($field->input_type, ['date', 'datetime-local', 'time']) ? 'right-6' : 'right-0'"/>
    @enderror
</div>
