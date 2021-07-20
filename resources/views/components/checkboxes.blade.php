<div {{ $attributes->only('x-data') }} class="w-full">
    <fieldset wire:ignore class="{{ $wrapperClass }}">
        @foreach($options as $value => $label)
            @php $id = md5($id.$value.$label.$loop->index); @endphp
            <x-tall-checkbox
                :id="$id"
                :name="$name"
                :label="$label"
                :label-class="$labelClass"
                :class="$class"
                :attr="array_merge([
                    'wire:key' => $id,
                    'value' => $value,
                ], $attr)"
                {{ $attributes->except('x-data') }}
            />
        @endforeach
    </fieldset>
</div>
