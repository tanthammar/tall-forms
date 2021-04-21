<div {{ $attributes->merge(['class' => "flex {$field->class}"]) }}>
    <input
        type="radio"
        value="{{ $value }}"
        name="{{ $field->key }}"
        id="{{ $id }}"
        @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    />
    <div class="tf-radio-label-spacing">
        <label for="{{ $id }}" class="tf-radio-label">
            {{ $label }}
        </label>
    </div>
</div>
