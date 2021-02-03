<div class="{{$field->class}}">
    @if($field->appendPrefix || $field->hasAppendIcon)
        <div class="w-full flex"> {{-- flex wrapper --}}
            <div class="w-full justify-self-start relative">  {{-- input & left icons/prefixes wrapper --}}
                @endif
                @if($field->prefix || $field->hasIcon)
                    <div class="w-full flex">  {{-- left icons/prefixes and input wrapper --}}
                        <span class="{{ $icon_span }}">
                            @if($field->icon)
                                <span class="mx-1">@svg($field->icon, 'h-6 w-6')</span>
                            @endif
                            @if($field->tallIcon)
                                <span class="mx-1"><x-tall-svg :path="$field->tallIcon" class="h-6 w-6" /></span>
                            @endif
                            @if($field->htmlIcon)
                                <span class="mx-1">{!! $field->htmlIcon !!}</span>
                            @endif
                            @if($field->prefix)
                                <span class="mx-1 whitespace-no-wrap">{{ $field->prefix }}</span>
                            @endif
                        </span>
                        @endif

                        <input
                                value="{{ old($field->key) }}"
                                @if($required) required @endif
                                @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
                                {{ $attributes->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }}
                        />
                        @if($field->prefix || $field->hasIcon)
                    </div>  {{-- /left icons/prefixes and input wrapper --}}
                @endif

                @if($field->appendPrefix || $field->hasAppendIcon)
                    @error($field->key)
                    <x-tall-error-icon
                            :right="in_array($field->input_type, ['date', 'datetime-local', 'time']) ? 'right-6' : 'right-0'"/>
                    @enderror
            </div>  {{-- /left icons/prefixes and input wrapper --}}
            <div class="justify-self-end {{ $append_iconWrapper_span }}">

                <span class="{{ $append_icon_span }}">
                    @if($field->appendIcon)
                        <span class="mx-1">@svg($field->appendIcon, 'h-6 w-6')</span>
                    @endif
                    @if($field->tallAppendIcon)
                        <span class="mx-1"><x-tall-svg :path="$field->tallAppendIcon" class="h-6 w-6" /></span>
                    @endif
                    @if($field->htmlAppendIcon)
                        <span class="mx-1">{!! $field->htmlAppendIcon !!}</span>
                    @endif
                    @if($field->appendPrefix)
                        <span class="mx-1 whitespace-no-wrap">{{ $field->appendPrefix }}</span>
                    @endif
                </span>
            </div>
        </div>  {{-- /flex wrapper --}}
    @else
        @error($field->key)
        <x-tall-error-icon
                :right="in_array($field->input_type, ['date', 'datetime-local', 'time']) ? 'right-6' : 'right-0'"/>
        @enderror
    @endif
</div>
