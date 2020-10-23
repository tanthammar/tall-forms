<div {{ $attributes->merge(['class' => $class()]) }}>
    <div class="tf-range-wrapper">
        <div class="tf-range-value">{{ data_get($this, $temp_key) ?? $min }}</div>
        <div class="tf-range-labels">{{$min}}</div>
        <input {{ $field->wire }}="{{ $temp_key }}"
        value="{{ old($temp_key) }}"
        name="{{ $temp_key }}"
        type="range"
        min="{{ $min }}" max="{{ $max }}" step="{{ $step }}"
        @foreach($attr as $key => $value) {{ $key }}="{{ $value }}" @endforeach
        />
        <div class="tf-range-labels">{{ $max }}</div>
    </div>
</div>
