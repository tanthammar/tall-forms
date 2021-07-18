<div {{ $attributes->only('x-data') }} class="flex {{ $wrapperClass }}">
<input
    type="checkbox"
    id="{{ $id }}"
    name="{{ $id }}"
    @foreach($attr as $key => $value) {{$key}}="{{$value}}" @endforeach
    {{ $attributes->except('x-data')->merge(['class' => $class ]) }}
    />
    <div class="tf-checkbox-label-spacing">
        <label for="{{ $id }}" class="{{ $labelClass }}">
            {{ $label }}
        </label>
    </div>
</div>
