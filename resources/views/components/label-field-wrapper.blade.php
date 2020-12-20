<div class="{{ $class() }}">
    {{-- label column --}}
    @if($field->show_label)
        <div class="{{ $labelWidth() }} {{ $field->labelWrapperClass }}">
            <label for="{{ $field->key }}" class="{{ $field->labelClass }}">
                {{$field->label}} <span class="tf-label-suffix">{{ $field->labelSuffix }}</span>
            </label>
            @if(!$field->afterLabelView && $field->afterLabel)
                <div class="tf-after-label">
                    {{ $field->afterLabel }}
                </div>
            @endif
            @if(filled($field->afterLabelView))
                @include($field->afterLabelView)
            @endif
        </div>
    @endif
    {{-- field column --}}
    <div class="{{ $fieldWidth() }}">
        {{ $slot }}
    </div>
</div>
