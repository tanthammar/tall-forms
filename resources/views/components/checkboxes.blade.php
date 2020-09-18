<div {{ $attributes->merge(['class' => "flex {$field->class}"]) }}>
    <input
        type="checkbox"
        value="{{ $value }}"
        name="{{ $temp_key }}"
        @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    />
    <div class="{{ $labelSpacingClass() }}">
        <span class="{{ $labelClass() }}">
            {{ $label }}
        </span>
    </div>
</div>
