@if($field->input_type === 'hidden')
    <input {{ $field->wire }}="{{ $temp_key }}" name="{{ $temp_key }}" type="hidden"
    autocomplete="{{ $field->autocomplete }}" class="nosy"
    @foreach($field->getAttr('field') as $key => $value) {{$key}}="{{$value}}" @endforeach/>
@else
    <div class="{{$field->wrapperClass}} {{$field->class}}">
        @if($field->prefix || $field->icon)
            <span
                class="inline-flex items-center px-1 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            @if($field->icon)
                    <span class="mx-1">@svg($icon, 'h-4 w-4')</span>
                @endif
                @if($field->prefix)
                    <span class="mx-1">{{ $field->prefix }}</span>
                @endif
        </span>
        @endif
        <x-tall-input :field="$field" :temp-key="$temp_key" />
        @error($temp_key)
        <x-tall-error-icon :right="in_array($field->input_type, ['date', 'datetime-local', 'time']) ? 'right-6' : 'right-0'" />
        @enderror
    </div>
@endif
