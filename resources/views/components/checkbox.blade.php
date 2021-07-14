<div x-data="{ {{ $options()['x-model'] }}: @entangle($wireModel){{$deferEntangle}} }" class="flex {{ $wrapperClass }}">
<input
    type="checkbox"
    value="{{ old($wireModel) }}"
    @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
    {{ $attributes->merge([ 'class' => $class() ]) }}
    />
    <div class="tf-checkbox-label-spacing">
        <label for="{{ \Str::slug($wireModel) }}" class="tf-checkbox-label">
            {{ $label }}
        </label>
    </div>
</div>
