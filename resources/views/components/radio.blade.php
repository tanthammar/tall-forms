<div {{ $attributes->merge(['class' => "flex {$field->class}"]) }}>
    <input
        type="radio"
        value="{{ $value }}"
        name="{{ $temp_key }}"
        @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    />
    <div class="tall-forms-radio-label-spacing">
        <span class="tall-forms-radio-label">
            {{ $label }}
        </span>
    </div>
</div>
