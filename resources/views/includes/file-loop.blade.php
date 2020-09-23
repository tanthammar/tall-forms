@if(!$errors->has($field->multiple ? $field->name.'.'.$loop->index : $field->name))
    {{--avoid showing files that didn't pass validation --}}
<li class="{{ $li }}">
    <div>
        {{--Temporary urls are only available for file type image--}}
        @if( \Str::startsWith($file->getMimeType(), 'image') )
            <div class="{{ $thumbWrapper }}">
                <img class="{{ $thumbImg }}" src="{{ $file->temporaryUrl() }}" alt="{{ $file->getClientOriginalName() }}"/>
            </div>
        @else
            <div class="{{ $iconWrapper }}">
                @svg(config('tall-forms.file-icon').$this->fileIcon($file->getMimeType()), "h-4 w-4")
            </div>
        @endif
    </div>
    <div class="flex-1 px-2">{{ $file->getClientOriginalName() }}</div>
    <button type="button" class="{{ $deleteButton() }}"
            onclick="confirm('{{ trans(config('tall-forms.are-u-sure')) }}') || event.stopImmediatePropagation();"
            wire:click.prevent="deleteSingleTempFile('{{ $field->name }}', '{{ isset($loop) ? $loop->index : null }}')">
        <span class="px-2" wire:loading wire:target="deleteSingleTempFile"><x-tall-spinner /></span>
        @svg(config('tall-forms.trash-icon'), 'h-4 w-4')
    </button>
</li>
@endif
