<div class="w-full my-1">
    @if(blank($fieldValue) || $errors->has($field->multiple ? $field->name.'.*' : $field->name))
        {{--only show the file input if the field is empty or there are validation errors, to force the user to upload new files or delete existing. --}}
        <div x-data="{ isUploading: false }"
             x-on:livewire-upload-start="isUploading = true; $wire.clearFileUploadError('{{ $field->multiple ? $field->name.'.*': $field->name }}');"
             x-on:livewire-upload-finish="isUploading = false"
             x-on:livewire-upload-error="isUploading = false"
             class="{{ $showFileUploadError || $errors->has($field->multiple ? $field->name.'.*': $field->name) ? $inputWrapperError() : $inputWrapper() }}">
            <div class="tf-file-upload-spinner-wrapper">
                {{-- <div x-cloak x-show="isUploading">--}}
                <div wire:loading wire:target="{{ $field->name }}">
                    <x-tall-spinner/>
                </div>
                <div x-show="!isUploading">
                    <x-tall-svg :path="config('tall-forms.file-upload')" class="tf-file-upload-icon" />
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
        <ul class="tf-file-upload-ul">
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
    @error($field->multiple ? $field->name.'.*': $field->name)
    @foreach($errors->get($field->multiple ? $field->name.'.*': $field->name) as $message)
        <p wire:key="{{ $loop->index }}" class="tf-error">{{ $field->multiple ? \Tanthammar\TallForms\ErrorMessage::parse($message[0]) : \Tanthammar\TallForms\ErrorMessage::parse($message) }}</p>
    @endforeach
        @if(!$showFileUploadError)<p class="tf-error">{{ $uploadFileError }}</p>@endif
    @enderror
    {{--show components general validation error --}}
    @if($showFileUploadError && $showFileUploadErrorFor == $field->name)<p class="tf-error">{{ $uploadFileError }}</p>@endif
</div>
