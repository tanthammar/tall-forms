@if($field->show_label)
    <div class="w-full pr-4 {{ $field->inline
        ? $field->labelW . ' ' . ($field->inlineLabelAlignment ?? $inlineLabelAlignment)
        : config('tall-forms.component-attributes.stacked-label-alignment') }}">
        <x-tall-attr tag="label" :for="$field->name" :attr="$field->getAttr('label')">
            {{$field->label}} <span class="{{ config('tall-forms.field-attributes.label-suffix') }}">{{ $field->labelSuffix }}</span>
        </x-tall-attr>
        @if(!$field->afterLabelView && $field->afterLabel)
            <x-tall-attr :attr="$field->getAttr('after-label')">
                {{ $field->afterLabel }}
            </x-tall-attr>
        @endif
        @if(filled($field->afterLabelView))
            @include($field->afterLabelView)
        @endif
    </div>
@endif
