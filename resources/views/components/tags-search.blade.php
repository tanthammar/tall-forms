<div x-data="tagsSearch({
        searchInput: $wire.entangle('{{$field->searchKey}}'),
        tags: $wire.entangle('{{ $field->key }}'){{ $field->deferString }},
        open: false,
    })"
     x-on:click.away="clearInput" class="{{$field->wrapperClass}}">
    <div @class([
            'block w-full transition duration-75 divide-y rounded focus-within:shadow-md border overflow-hidden',
            'border-gray-300 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500' => !$errors->has("$field->key.*"),
            'shake border-red-500 ring-red-500 focus-within:border-red-500 focus-within:ring-2 focus-within:ring-red-500' => $errors->has("$field->key.*"),
    ])>
        @unless($field->disabled)
            <input
                autocomplete="off"
                placeholder="{{ $field->placeholder }}"
                id="{{ $field->id }}"
                type="text"
                x-model.debounce.{{ $field->debounce }}ms="searchInput"
                @if($field->allowNew)
                x-on:keydown.enter.stop.prevent="addTag"
                x-on:keydown.,.stop.prevent="addTag"
                x-on:keydown.period.stop.prevent="addTag"
                x-on:keydown.space.stop.prevent="addTag"
                @endif
                x-on:input="open = true"
                x-on:keydown.escape="clearInput"
                x-on:keydown.clear="clearInput"
                x-on:keydown.delete="clearInput"
                class="block w-full border-0"
            />
            <div :class="[open ? 'block' : 'hidden']">
                <div class="absolute z-40 left-0 mt-2 {{ $field->listWidth ?? 'w-full' }}">
                    <div class="py-1 text-sm bg-white rounded shadow-lg border border-gray-300">
                        <button x-show="searchInput !== ''"
                            x-on:click.prevent.stop="addTag"
                            class="tf-tags-color inline-flex leading-4 items-center text-sm rounded py-1 px-2 cursor-default"
                            type="button">
                            <span x-text="searchInput"></span>
                        </button>
                        @forelse($field->options as $tag)
                            <button
                                x-on:click.prevent.stop="addExistingTag('{{ $tag }}')"
                                class="tf-tags-color inline-flex leading-4 items-center text-sm rounded py-1 px-2 cursor-default"
                                type="button">
                                <span>{{ $tag }}</span>
                            </button>
                        @empty
                            <div x-on:click.prevent.stop class="inline-flex text-sm">
                                <x-tall-spinner/>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endunless

        <div x-show="tags.length" class="bg-white relative w-full pb-2 space-x-2 space-y-2">
            <template x-for="tag in tags" x-bind:key="tag">
                <button
                    type="button"
                    @if($field->disabled)
                    x-on:click.prevent.stop
                    @else
                    x-on:click="deleteTag(tag)"
                    @endif
                    @class([
                        'tf-tags-color inline-flex leading-4 items-center text-sm rounded py-1 px-2 space-x-1',
                        'cursor-default' => $field->disabled,
                    ])>
                    <span x-text="tag"></span>

                    @unless($field->disabled)
                        <span class="tf-tags-x-color">x</span>
                    @endunless
                </button>
            </template>
        </div>
    </div>
    <div>
        @if ($errors->any())
            @foreach ($errors->all() as $message)
                <div>{{ $message }}</div>
            @endforeach
        @endif
    </div>
</div>
@tfonce('scripts:tagssearchcomponent')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('tagsSearch', (config) => ({
            searchInput: config.searchInput,
            tags: config.tags,
            open: config.open,
            addTag() {
                this.searchInput = this.searchInput.trim()
                if (this.searchInput === '') {
                    this.clearInput()
                    return
                }
                if (this.tags.includes(this.searchInput)) {
                    this.clearInput()
                    return
                }
                this.tags.push(this.searchInput)
                this.clearInput()
            },
            addExistingTag(tag)
            {
                if (this.tags.includes(tag)) {
                    //this.clearInput(), the search result can still remain open
                    return
                }
                this.tags.push(tag)
                this.clearInput()
            },
            deleteTag(tagToDelete) {
                this.tags.splice(this.tags.indexOf(tagToDelete), 1)
            },
            clearInput() {
                this.searchInput = ''
                this.open = false
            }
        }))
    })
</script>
@endtfonce
