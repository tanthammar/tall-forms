<div {{ $attributes->merge(['class' => "flex {$field->class}"]) }}>
    <input
        type="checkbox"
        value="{{ $value }}"
        name="{{ $field->key }}"
        id="{{ $id }}"
        @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    />
    <div class="tf-checkbox-label-spacing">
        <label for="{{ $id }}" class="tf-checkbox-label">
            {{ $label }}
        </label>
    </div>
</div>
