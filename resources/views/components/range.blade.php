<div {{ $attributes->merge(['class' => $class()]) }}>
    <div class="tf-range-wrapper">
        <div class="tf-range-value">{{ data_get($this, $field->key) ?? $min }}</div>
        <div class="tf-range-labels">{{$min}}</div>
        <input {{ $field->wire }}="{{ $field->key }}"
        value="{{ old($field->key) }}"
        name="{{ $field->key }}"
        type="range"
        min="{{ $min }}" max="{{ $max }}" step="{{ $step }}"
        @foreach($attr as $key => $value) {{ $key }}="{{ $value }}" @endforeach
        />
        <div class="tf-range-labels">{{ $max }}</div>
    </div>
</div>
