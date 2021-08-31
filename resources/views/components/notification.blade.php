@props([
    'show' => session()->has('notify') ? 'true' : 'false',
    'message' => data_get(session('notify'), 'message', ''),
    'bg' => data_get(session('notify'), 'bg', 'tf-bg-success'),
    'icon' => data_get(session('notify'), 'icon', 'check'),
    'iconcolor' => data_get(session('notify'), 'iconcolor', 'text-white'),
])

<div x-data="{
        showMessage: {{ $show }},
        message: '{{ $message }}',
        bg: '{{ $bg }}',
        icon: '{{ $icon }}',
        iconcolor: '{{ $iconcolor }}',
        showErrors: false,
        errors: [],
        newMessage(obj) {
            this.showMessage = true
            this.message = obj.message;
            this.bg = obj.bg
            this.icon = obj.icon
            this.iconcolor = obj.iconcolor
            setTimeout(() => { this.showMessage = false }, 5000)
        },
        addError(error) {
            this.showErrors = true
            this.errors.push(error)
            setTimeout(() => { this.showErrors = false }, 5000)
        },
        removeError(error) {
            this.errors.splice(this.errors.indexOf(error), 1)
        },
        replaceErrors(errors) {
            this.showErrors = true;
            this.errors = Array.from(errors)
            setTimeout(() => { this.showErrors = false }, 5000)
        },
        clearErrors() {
            this.showErrors = false;
            this.errors = []
        },
        showErrors() {
            this.showErrors = true
            setTimeout(() => { this.showErrors = false }, 5000)
        }
    }"
    x-on:notify.window="newMessage($event.detail)"
    x-on:add-error.window="addError($event.detail)"
    x-on:replace-errors.window="replaceErrors($event.detail)"
    x-on:clear-errors.window="clearErrors()"
    x-on:show-errors.window="showErrors()"
    class="fixed inset-0 flex flex-col items-end space-y-2 px-4 py-6 pointer-events-none sm:p-6 isolate z-50"
    style="margin-top: 50px">
    <div x-cloak
         x-show="showMessage"
         x-transition:enter="transform ease-out duration-300 transition"
         x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-bind:class="bg"
         class="w-full max-w-sm rounded-lg shadow-lg pointer-events-auto">
        <div class="overflow-hidden rounded-lg shadow-xs">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg x-show="icon == 'info'" :class="iconcolor" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="icon == 'check'" :class="iconcolor" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="icon == 'exclamation'" :class="iconcolor" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="icon == 'warning'" :class="iconcolor" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <svg x-show="icon == 'happy'" :class="iconcolor" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="icon == 'sad'" :class="iconcolor" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p x-text="message" :class="iconcolor" class="text-sm font-medium leading-5"></p>
                    </div>
                    <div class="flex flex-shrink-0 ml-4">
                        <button type="button" x-on:click.prevent.stop="showMessage = false"
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
    <template x-for="(error, errorIndex) in errors" :key="errorIndex">
        <div x-cloak
        x-show="showErrors"
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="tf-bg-danger w-full max-w-sm rounded-lg shadow-lg pointer-events-auto">
            <div class="overflow-hidden rounded-lg shadow-xs">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p x-text="error.replace('form_data.', '')" class="text-sm font-medium leading-5 text-white"></p>
                    </div>
                    <div class="flex flex-shrink-0 ml-4">
                        <button type="button" x-on:click.prevent.stop="removeError(error)" class="inline-flex text-gray-100 transition duration-150 ease-in-out focus:outline-none focus:white">
                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </template>
</div>
