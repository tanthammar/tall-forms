<div x-data="{
        focusInput() {
            document.getElementById('id{{$_instance->id}}searchInput').focus();
        }
     }"
     class="w-full">
    @error('search')<p class="{{ $errorClass }}">{{ $field['errorMsg'] ?? $message }}</p>@enderror
    <div @tags-search-input-{{ $field['name'] }}-focus.window="focusInput()" class="flex flex-1 flex-wrap bg-white border rounded pl-2 pr-4 pt-2 pb-1">
        @foreach ($tags as $i => $tag)
            <span
                wire:key="id{{ md5($_instance->id.$i.$tag)}}"
                class="{{ $color }} inline-flex leading-4 items-center text-sm rounded py-1 px-2 mr-2 mb-1"
                style="user-select: none">
                <span>{{ $tag }}</span>
                <button wire:click.prevent="removeTag({{$i}})" type="button" class="pl-1 tf-tags-x-color text-lg leading-4 focus:outline-none">&times;</button>
            </span>
        @endforeach
        <input id="id{{$_instance->id}}searchInput" wire:model.debounce.350ms="search" wire:keydown.space.prevent="addFromSearch" name="search"
               class="flex-1 outline-none pt-1 pb-1 ml-2"
               style="min-width:10rem" placeholder="{{ $field['placeholder'] ?? 'Add tag...' }}" />
    </div>
    @if($field['help'])<p class="{{ $helpClass }} py-1">{{ $field['help'] }}</p>@endif
    <div class="flex items-center py-2">
        @foreach($options as $option)
            <button wire:click.prevent="addFromOptions('{{$option}}')" type="button">
                <span class="{{ $color }} inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 whitespace-no-wrap">
                    {{ $option ?? null }}
                </span>
            </button>
        @endforeach
    </div>
</div>
