{{-- not tested --}}
<x-tall-field-wrapper :inline="$field->inline" :colspan="$field->colspan" :field="$field->name" :label="$field->label"
    :labelW="$field->labelW" :fieldW="$field->fieldW">
    <div class="my-1 flex rounded-md shadow-sm w-full relative {{$fieldClass}}">
        <span
            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            Browse file
        </span>
        <input data-file="kdion" id="{{ $field->name }}" name="{{ $field->name }}" type="file"
            {{ $field->file_multiple ? 'multiple' : '' }} placeholder="{{ $field->placeholder }}" class="flex-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-none rounded-r-md
            @error($field->key) error placeholder-red-300 @enderror" />
        @error($field)
        <x-tall-error-icon :right="($type == 'date' || $type == 'datetime-local' || $type == 'time') ? 'right-6' : 'right-0'" @endif />
        @enderror
    </div>


    @if($form_data[$field->name])
    <ul class="border rounded dividy-y mt-2">
        @foreach($form_data[$field->name] as $key => $value)
        <li class="w-full py-2">
            <div class="flex items-center">
                <div class="flex-1">
                    <a href="{{ Storage::url($value['file']) }}" target="_blank">
                        @svg(config('tall-forms.file-icon')."{$value['mime_type']}", "h-4 w-4 mr-1"){{ $value['name'] }}
                        {{-- <i class="fa fa-fw {{ $this->fileIcon($value['mime_type']) }} mr-1"></i> --}}
                    </a>
                </div>
                <div class="flex-auto">
                    <x-button size="xs" color="danger" :icon="config('tall-forms.trash-icon')"
                        onclick="confirm('{{ __('Are you sure?') }}') || event.stopImmediatePropagation();"
                        wire:click="arrayRemove('{{ $field->name }}', '{{ $key }}')">
                    </x-button>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    @endif

    @if($help)<p class="help">{{ $help }}</p>@endif
    @error($field)<p class="error">{{ $errorMsg ?? $message }}</p>@enderror
</x-tall-field-wrapper>

@pushonce('scripts:kdionfile')
<script>
    // Code is inspired by Pastor Ryan Hayden
    // https://github.com/livewire/livewire/issues/106
    // Thank you, sir!
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('input[data-file="kdion"]').forEach(file => {
            file.addEventListener('input', event => {
                let form_data = new FormData();
                form_data.append('component', @json(get_class($this)));
                form_data.append('field_name', file.id);

                for (let i = 0; i < event.target.files.length; i++) {
                    form_data.append('files[]', event.target.files[i]);
                }

                axios.post('{{ route('tall-forms.file-upload') }}', form_data, {
                    headers: {'Content-Type': 'multipart/form-data'}
                }).then(response => {
                    window.livewire.emit('fileUpdate', response.data.field_name, response.data.uploaded_files);
                });
            })
        });
    });
</script>
@endpushonce
