@if(!$errors->has($field->multiple ? $field->name.'.'.$loop->index : $field->name))
    {{--avoid showing files that didn't pass validation --}}
<li class="w-full flex items-center px-2 py-1 border rounded">
    <div>
        {{--Temporary urls are only available for file type image--}}
        @if( \Str::startsWith($file->getMimeType(), 'image') )
            <div class="border h-8 w-8 rounded-full">
                <img class="h-8 w-full object-cover rounded-full" src="{{ $file->temporaryUrl() }}" alt="{{ $file->getClientOriginalName() }}"/>
            </div>
        @else
            <div class="border h-8 w-8 rounded-full flex items-center justify-around">
                @svg(config('tall-forms.file-icon').$this->fileIcon($file->getMimeType()), "h-4 w-4")
            </div>
        @endif
    </div>
    <div class="flex-1 px-2">{{ $file->getClientOriginalName() }}</div>
    <button class="{{config('tall-forms.negative')}} rounded shadow p-2 text-white flex items-center"
            onclick="confirm('{{ trans(config('tall-forms.are-u-sure')) }}') || event.stopImmediatePropagation();"
            wire:click="deleteSingleTempFile('{{ $field->name }}', '{{ optional($loop)->index }}')">
        <span class="px-2" wire:loading wire:target="deleteSingleTempFile"><x-tall-spinner /></span>
        @svg(config('tall-forms.trash-icon'), 'h-4 w-4')
    </button>
</li>
@endif
