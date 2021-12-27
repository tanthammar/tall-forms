@props([
    'xtext', 'xcolor', 'xclick', 'xbg', 'xclick'
])
<div x-cloak
     x-transition:enter="transform ease-out duration-300 transition"
     x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
     x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
     x-transition:leave="transition ease-in duration-100"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     x-bind:class="{{ $xbg }}"
     class="w-full max-w-sm rounded-lg shadow-lg pointer-events-auto"
     {{ $attributes }}>
    <div class="overflow-hidden rounded-lg shadow-xs">
        <div class="p-4">
            <div class="flex items-start">
                <div class="shrink-0">
                    {{ $icon }}
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p x-text="{{ $xtext }}" x-bind:class="{{ $xcolor }}" class="text-sm font-medium leading-5">{{ $slot }}</p>
                </div>
                <div class="flex shrink-0 ml-4">
                    <button type="button" x-on:click.prevent.stop="{{ $xclick }}"
                            class="inline-flex text-gray-100 transition duration-150 ease-in-out focus:outline-none focus:white">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
