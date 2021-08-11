<div x-data="{
    optionsVisible: false,
    field: @entangle($field->key),
    selected: null,
    searchInput: @entangle($field->searchKey)}
" class="{{ $field->wrapperClass }}">
    <div class="relative">
        <div class="relative">
            <input
                x-model.debounce.{{ $field->debounce }}ms="searchInput"
                x-on:keydown.escape="optionsVisible = false"
                x-on:input="optionsVisible = true"
                x-on:click.stop="optionsVisible = true"
                x-on:click.stop.outside="optionsVisible = false"
                {{ $attributes->except(array_keys($attr))->merge($attr)->merge(['class' => $errors->has($field->key) ? $field->errorClass : $field->class ]) }}
            />
            <div x-on:click.stop.prevent="searchInput = ''; optionsVisible = false;" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                <!-- Heroicon name: x -->
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        <div
            x-cloak
            x-show="optionsVisible"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="tf-search-dropdown {{ $field->listWidth }}">
            <ul
                x-on:keydown.escape="optionsVisible = false"
                x-on:keydown.arrow-up.prevent="select > 0 ? select -= 1 : select = 0"
                x-on:keydown.arrow-down.prevent="select < {{ $field->options->length ?? 0 }} ? select += 1 : select = {{ $field->options->length ?? 0 }}"
                tabindex="-1"
                role="listbox"
                class="tf-search-ul" x-max="1">
                @forelse($field->options as $value => $key)
                <li
                    role="option"
                    wire:key="id{{ md5($field->id.$key) }}"
                    x-on:click.stop.prevent="field = '{{ $key }}'; selected = {{ $loop->index }}; optionsVisible = false; searchInput = '{{ $value }}';"
                    x-on:mouseenter="selected = {{ $loop->index }}"
                    x-on:mouseleave="selected = null"
                    :class="{ 'tf-search-selected': selected === {{ $loop->index }}, 'tf-search-unselected': !(selected === {{ $loop->index }}) }"
                    class="tf-search-li">
                    <span
                        x-state:on="Selected"
                        x-state:off="Not Selected"
                        :class="{ 'font-semibold': field === '{{ $key }}', 'font-normal': !(field === '{{ $key }}') }"
                        class="font-normal truncate">
                        {{ $value }}
                    </span>
                    <span
                        x-show="field === '{{ $key }}'"
                        :class="{ 'tf-search-icon-selected': selected === {{ $loop->index }}, 'tf-search-icon-unselected': !(selected === {{ $loop->index }}) }"
                        class="tf-search-icon">
                    <svg class="h-5 w-5" x-description="Heroicon name: check" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                  </span>
                </li>
                @empty
                    <li class="mr-2 flex pl-2 space-x-2">
                        <x-tall-spinner/>
                        <span class="text-grey-500 text-xs leading-normal">Searching ...</span>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
