<div class="w-full">
    @if(blank($this->{$field->name}) || $errors->has($field->multiple ? $field->name.'.*' : $field->name))
        {{--only show the file input if the field is empty or there are validation errors, to force the user to upload new files or delete existing. --}}
        <div x-data="{ isUploading: false }"
             x-on:livewire-upload-start="isUploading = true; $wire.clearFileUploadError('{{ $field->multiple ? $field->name.'.*': $field->name }}');"
             x-on:livewire-upload-finish="isUploading = false"
             x-on:livewire-upload-error="isUploading = false"
             class="{{ $this->showFileUploadError || $errors->has($field->multiple ? $field->name.'.*': $field->name) ? $inputWrapperError() : $inputWrapper() }}">
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
                @if($this->showFileUploadError) :value="null" @endif
                {{ $field->multiple ? 'multiple' : '' }}
                accept="{{$field->accept}}"
                class="{{ $class() }}"/>
        </div>
    @endif
    @if(filled($this->{$field->name}))
        <ul class="{{ $ul }}">
            @if($field->multiple)
                @foreach($this->{$field->name} as $file)
                    @if(filled($file)) @include('tall-forms::includes.file-loop') @endif
                @endforeach
            @else
                @php $file = $this->{$field->name}; @endphp
                @if(filled($file)) @include('tall-forms::includes.file-loop') @endif
            @endif
        </ul>
    @endif
    {{--show livewire file upload default validation error--}}
    @php $errorClass = $this->getAttr('error') @endphp
    @error($field->multiple ? $field->name.'.*': $field->name)
    @foreach($errors->get($field->multiple ? $field->name.'.*': $field->name) as $message)
        <p class="{{ $errorClass }}">{{ $field->multiple ? $this->errorMessage($message[0]) : $this->errorMessage($message) }}</p>
    @endforeach
        @if(!$this->showFileUploadError)<p class="{{ $errorClass }}">{{ $field->errorMsg ?? $this->fileError }}</p>@endif
    @enderror
    {{--show components general validation error --}}
    @if($this->showFileUploadError)<p class="{{ $errorClass }}">{{ $field->errorMsg ?? $this->fileError }}</p>@endif
</div>
