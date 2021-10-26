<div {{ $attributes->only('x-data') }} class="{{$field->wrapperClass}}">
    @if($field->prefix || $field->hasIcon)
        <span class="{{ $field->icon_span }} {{ $field->left_border }}">
            @if($field->icon)
                <span class="mx-1">@svg($field->icon, "h-6 w-6 $field->iconClass")</span>
            @endif
            @if($field->tallIcon)
                <span class="mx-1"><x-tall-svg :path="$field->tallIcon" class="h-6 w-6 fill-current" /></span>
            @endif
            @if($field->htmlIcon)
                <span class="mx-1">{!! $field->htmlIcon !!}</span>
            @endif
            @if($field->prefix)
                <span class="mx-1 whitespace-no-wrap">{{ $field->prefix }}</span>
            @endif
        </span>
    @endif
    <div class="relative w-full">
        @unless($field->disabled)
        <input
            @if($field->required) required @endif
            {{ $attributes->except([...array_keys($attr), 'x-data', 'required', 'disabled'])->merge($attr)->merge(['class' => $errors->has($field->key) ? $field->errorClass : $field->class ]) }}
        />
        @else
            <input type="{{ $field->input_type ?? 'text' }}" disabled value="{{ data_get($this, $field->key) }}" />
        @endunless
        @error($field->key)
            <x-tall-error-icon :right="in_array($field->type, ['date', 'datetime-local', 'time']) ? 'right-6' : 'right-0'"/>
        @enderror
    </div>
    @if($field->suffix || $field->sfxHasIcon)
        <span class="{{ $field->icon_span }} {{ $field->right_border }}">
            @if($field->sfxIcon)
                <span class="mx-1">@svg($field->sfxIcon, "h-6 w-6 $field->sfxIconClass")</span>
            @endif
            @if($field->sfxTallIcon)
                <span class="mx-1"><x-tall-svg :path="$field->sfxTallIcon" class="h-6 w-6 fill-current" /></span>
            @endif
            @if($field->sfxHtmlIcon)
                <span class="mx-1">{!! $field->sfxHtmlIcon !!}</span>
            @endif
            @if($field->suffix)
                <span class="mx-1 whitespace-no-wrap">{{ $field->suffix }}</span>
            @endif
        </span>
    @endif
</div>
