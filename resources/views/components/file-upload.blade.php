<div class="{{ $field->wrapperClass }}" x-data="{ isUploading: false }">
    @if(blank($field->fieldValue) || $errors->has($field->multiple ? $field->name.'.*' : $field->name))
        {{--only show the file input if the field is empty or there are validation errors, to force the user to upload new files or delete existing. --}}
        <div wire:key="file-upload-blank{{md5($field->name)}}"
             x-on:livewire-upload-start="isUploading = true && $wire.clearFileUploadError('{{ $field->multiple ? $field->name.'.*': $field->name }}')"
             x-on:livewire-upload-finish="isUploading = false"
             x-on:livewire-upload-error="isUploading = false"
             class="{{ $showFileUploadError || $errors->has($field->multiple ? $field->name.'.*': $field->name) ? $field->errorClass : $field->class }}">
            <div class="tf-file-upload-spinner-wrapper">
                {{-- <div x-cloak x-show="isUploading">--}}
                <div wire:loading wire:target="{{ $field->name }}">
                    <x-tall-spinner/>
                </div>
                <div x-show="!isUploading">
                    <x-tall-svg :path="$field->tall_svg_upload" class="tf-file-upload-icon fill-current" />
                </div>
            </div>
            {{--intentionally removed input id if multiple forms, with the same field name --}}
            <input
                wire:model="{{ $field->name }}"
                id="{{ $field->id }}"
                name="{{ $field->name }}"
                type="file"
                @if($showFileUploadError && $showFileUploadErrorFor == $field->name) :value="null" @endif
                {{ $field->multiple ? 'multiple' : '' }}
                accept="{{$field->accept}}"
                class="{{ $field->inputClass }}"/>
        </div>
    @endif
    @if(filled($field->fieldValue))
        <ul class="tf-file-upload-ul" wire:key="file-upload-filled{{md5($field->name)}}">
            @if($field->multiple)
                @foreach($field->fieldValue as $file)
                    @if(filled($file)) @include('tall-forms::includes.file-loop') @endif
                @endforeach
            @else
                @php $file = $field->fieldValue; @endphp
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

