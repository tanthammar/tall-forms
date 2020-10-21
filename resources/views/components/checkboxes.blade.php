<div {{ $attributes->merge(['class' => "flex {$field->class}"]) }}>
    <input
        type="checkbox"
        value="{{ $value }}"
        name="{{ $temp_key }}"
        @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    />
    <div class="tall-forms-checkbox-label-spacing">
        <span class="tall-forms-checkbox-label">
            {{ $label }}
        </span>
    </div>
</div>
