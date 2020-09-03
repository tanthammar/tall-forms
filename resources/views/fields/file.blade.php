<x-tall-field-wrapper :inline="$field->inline ?? $inline" :field="$field->name" :label="$field->label"
                      :labelSuffix="$field->labelSuffix"
                      :labelW="$field->labelW" :fieldW="$field->fieldW">
    @if(blank(${$field->name}) || $errors->has($field->multiple ? $field->name.'.*' : $field->name))
        {{--only show the file input if the field is empty or there are validation errors, to force the user to upload new files or delete existing. --}}
        <div x-data="{ isUploading: false }"
             x-on:livewire-upload-start="isUploading = true"
             x-on:livewire-upload-finish="isUploading = false"
             x-on:livewire-upload-error="isUploading = false"
             class="my-1 flex rounded-md shadow-sm w-full relative {{ $field->class }}">
            <div
                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                {{-- <div x-cloak x-show="isUploading">--}}
                <div wire:loading wire:target="{{ $field->name }}">
                    <x-tall-spinner/>
                </div>
                <div x-show="!isUploading">
                    @svg(config('tall-forms.file-upload'), "h-4 w-4")
                </div>
            </div>
            {{--intentionally removed input id if multiple forms, with the same field name --}}
            <input
{{--                wire:model="{{ $field->name }}"--}}
                x-data="files = $wire.entangle('{{ $field->name }}')"
                x-model="files"
                x-on:change.prevent="checkFileSize($event.target.files, {{ $field->maxBytes }}, '{{ $field->sizeLimitAlert }}')"
                name="{{ $field->name }}"
                type="file"
                {{ $field->multiple ? 'multiple' : '' }}
                placeholder="{{ $field->placeholder }}"
                accept="{{$field->accept}}"
                class="flex-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-none rounded-r-md @error($field->key) error placeholder-red-300 @enderror"/>
        </div>
    @endif

    @if(filled(${$field->name}))
        <ul class="space-y-2 my-2">
            @if($field->multiple)
                @foreach(${$field->name} as $file)
                    @if(filled($file)) @include('tall-forms::includes.file-loop') @endif
                @endforeach
            @else
                @php $file = ${$field->name}; @endphp
                @if(filled($file)) @include('tall-forms::includes.file-loop') @endif
            @endif
        </ul>
    @endif
    @if($field->help)<p class="help">{{ $field->help }}</p>@endif
    {{--show livewire file upload default validation error--}}
    @error($field->multiple ? $field->name.'.*': $field->name)
    @foreach($errors->get($field->multiple ? $field->name.'.*': $field->name) as $message)
        <p class="error">{{ $field->multiple ? $this->errorMessage($message[0]) : $this->errorMessage($message) }}</p>
    @endforeach
    <p class="error">{{ $field->errorMsg ?? $this->fileError }}</p>
    @enderror
    {{--show components general validation error --}}
    @if($showFileUploadError)<p class="error">{{ $field->errorMsg ?? $this->fileError }}</p>@endif
</x-tall-field-wrapper>
@once
<script>
function defaultFileUpload() {
    return {
        files: {},
        checkFileSize(files, maxBytes, alertMsg) {
            if (files && files[0] && maxBytes > 0) {
                Array.from(files).forEach(file => {
                    console.info(file.size);
                    if (file.size > maxBytes) {
                        alert(alertMsg);
                        this.files = null;
                    }
                });
            }
        }
    }
}
</script>
@endonce

