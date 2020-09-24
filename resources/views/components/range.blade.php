<div {{ $attributes->merge(['class' => $class()]) }}>
    <div class="{{ $wrapper }}">
        <div class="{{ $range_value_class }}">{{ data_get($this, $temp_key) ?? $min }}</div>
        <div class="{{ $range_labels }}">{{$min}}</div>
        <input {{ $field->wire }}="{{ $temp_key }}"
        value="{{ old($temp_key) }}"
        name="{{ $temp_key }}"
        type="range"
        min="{{ $min }}" max="{{ $max }}" step="{{ $step }}"
        @foreach($attr as $key => $value) {{ $key }}="{{ $value }}" @endforeach
        />
        <div class="{{ $range_labels }}">{{ $max }}</div>
    </div>
</div>
