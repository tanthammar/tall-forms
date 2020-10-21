<div class="w-full">
    @if(blank($fieldValue) || $errors->has($field->multiple ? $field->name.'.*' : $field->name))
        {{--only show the file input if the field is empty or there are validation errors, to force the user to upload new files or delete existing. --}}
        <div x-data="{ isUploading: false }"
             x-on:livewire-upload-start="isUploading = true; $wire.clearFileUploadError('{{ $field->multiple ? $field->name.'.*': $field->name }}');"
             x-on:livewire-upload-finish="isUploading = false"
             x-on:livewire-upload-error="isUploading = false"
             class="{{ $showFileUploadError || $errors->has($field->multiple ? $field->name.'.*': $field->name) ? $inputWrapperError() : $inputWrapper() }}">
            <div class="{{ $spinnerWrapper }}">
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
                wire:model="{{ $field->name }}"
                name="{{ $field->name }}"
                type="file"
                @if($showFileUploadError && $showFileUploadErrorFor == $field->name) :value="null" @endif
                {{ $field->multiple ? 'multiple' : '' }}
                accept="{{$field->accept}}"
                class="{{ $class() }}"/>
        </div>
    @endif
    @if(filled($fieldValue))
        <ul class="{{ $ul }}">
            @if($field->multiple)
                @foreach($fieldValue as $file)
                    @if(filled($file)) @include('tall-forms::includes.file-loop') @endif
                @endforeach
            @else
                @php $file = $fieldValue; @endphp
                @if(filled($file)) @include('tall-forms::includes.file-loop') @endif
            @endif
        </ul>
    @endif
    {{--show livewire file upload default validation error--}}
    @php $errorClass = \Tanthammar\TallForms\ConfigAttr::key('error') @endphp
    @error($field->multiple ? $field->name.'.*': $field->name)
    @foreach($errors->get($field->multiple ? $field->name.'.*': $field->name) as $message)
        <p wire:key="{{ $loop->index }}" class="{{ $errorClass }}">{{ $field->multiple ? \Tanthammar\TallForms\ErrorMessage::parse($message[0]) : \Tanthammar\TallForms\ErrorMessage::parse($message) }}</p>
    @endforeach
        @if(!$showFileUploadError)<p class="{{ $errorClass }}">{{ $uploadFileError }}</p>@endif
    @enderror
    {{--show components general validation error --}}
    @if($showFileUploadError && $showFileUploadErrorFor == $field->name)<p class="{{ $errorClass }}">{{ $uploadFileError }}</p>@endif
</div>
