<div {{ $attributes->merge(['class' => $class()]) }}>
    <div class="tall-forms-range-wrapper">
        <div class="tall-forms-range-value">{{ data_get($this, $temp_key) ?? $min }}</div>
        <div class="tall-forms-range-labels">{{$min}}</div>
        <input {{ $field->wire }}="{{ $temp_key }}"
        value="{{ old($temp_key) }}"
        name="{{ $temp_key }}"
        type="range"
        min="{{ $min }}" max="{{ $max }}" step="{{ $step }}"
        @foreach($attr as $key => $value) {{ $key }}="{{ $value }}" @endforeach
        />
        <div class="tall-forms-range-labels">{{ $max }}</div>
    </div>
</div>
