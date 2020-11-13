<div {{ $attributes->merge(['class' => "flex {$field->class}"]) }}>
<input
    type="checkbox"
    value="{{ old($field->key) }}"
    @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    />
    <div class="tf-checkbox-label-spacing">
        <span class="tf-checkbox-label">
            {{ $label ?? ''}}
        </span>
    </div>
</div>
