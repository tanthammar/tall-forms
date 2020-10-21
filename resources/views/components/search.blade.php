<div class="relative">
    <div class="relative">
        <input
            x-model.debounce.{{ $field->debounce }}="searchInput"
            type="text"
            placeholder="{{ $field->placeholder }}"
            x-on:keydown.escape="optionsVisible = false"
            x-on:input="optionsVisible = true"
            x-on:click.stop="optionsVisible = true"
            x-on:click.stop.away="optionsVisible = false"
            {{ $attributes->merge(['class' => $errors->has($temp_key) ? $error() : $class() ]) }}
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
        class="z-50 absolute mt-1 rounded-md bg-white shadow-lg {{ $listWidth }}">
        <ul
            x-on:keydown.escape="optionsVisible = false"
            x-on:keydown.arrow-up.prevent="select > 0 ? select -= 1 : select = 0"
            x-on:keydown.arrow-down.prevent="select < {{ optional($options)->length }} ? select += 1 : select = {{ optional($options)->length }}"
            tabindex="-1"
            role="listbox"
            class="max-h-60 rounded-md py-1 text-base leading-6 shadow-xs overflow-auto focus:outline-none sm:text-sm sm:leading-5" x-max="1">
            @forelse($options as $key => $value)
            <li
                role="option"
                wire:key="{{ md5($temp_key.$key) }}"
                x-on:click.stop.prevent="field = '{{ $key }}'; selected = {{ $loop->index }}; optionsVisible = false; searchInput = '{{ $value }}';"
                x-on:mouseenter="selected = {{ $loop->index }}"
                x-on:mouseleave="selected = null"
                :class="{ 'text-white bg-indigo-600': selected === {{ $loop->index }}, 'text-gray-900': !(selected === {{ $loop->index }}) }"
                class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9">
                <span
                    x-state:on="Selected"
                    x-state:off="Not Selected"
                    :class="{ 'font-semibold': field === '{{ $key }}', 'font-normal': !(field === '{{ $key }}') }"
                    class="font-normal truncate">
                    {{ $value }}
                </span>
                <span
                    x-show="field === '{{ $key }}'"
                    :class="{ 'text-white': selected === {{ $loop->index }}, 'text-indigo-600': !(selected === {{ $loop->index }}) }"
                    class="absolute inset-y-0 right-0 flex items-center pr-4">
                <svg class="h-5 w-5" x-description="Heroicon name: check" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
              </span>
            </li>
            @empty
                <li class="mr-2 flex pl-2 space-x-2">
                    <x-tall-spinner/>
                    <span class="text-grey-500 text-xs">Searching ...</span>
                </li>
            @endforelse
        </ul>
    </div>
</div>
