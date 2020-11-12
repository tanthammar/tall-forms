<div {{ $attributes->merge(['class' => "flex {$field->class}"]) }}>
    <input
        type="radio"
        value="{{ $value }}"
        name="{{ $field->key }}"
        @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    />
    <div class="tf-radio-label-spacing">
        <span class="tf-radio-label">
            {{ $label }}
        </span>
    </div>
</div>
