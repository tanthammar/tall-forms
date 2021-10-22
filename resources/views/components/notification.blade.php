@props([
    'show' => session()->has('notify') ? 'true' : 'false',
    'messages' => session()->has('notify') ? [
        'message' => data_get(session('notify'), 'message', ''),
        'bg' => data_get(session('notify'), 'bg', 'tf-notify-bg-default'),
        'icon' => data_get(session('notify'), 'icon', 'info'),
        'iconcolor' => data_get(session('notify'), 'iconcolor', 'text-white'),
        ] : [],
])
<div wire:ignore x-data="{
        showMessages: {{ $show }},
        messages: @js($messages),
        showErrors: false,
        errors: [],
        newMessage(obj) {
            this.showMessages = true
            this.messages.push(obj)
            setTimeout(() => { this.removeMessage(obj) }, 5000)
        },
        removeMessage(message) {
            this.messages.splice(this.messages.indexOf(message), 1)
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
    <template x-for="(message, messageIndex) in messages" :key="messageIndex">
        <x-tall-forms::alpine-alert
            x-show="showMessages" xbg="message.bg" xtext="message.message" xcolor="message.iconcolor" xclick="removeMessage(message)">
            <x-slot name="icon">
                <svg x-show="message.icon == 'info'" :class="message.iconcolor" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg x-show="message.icon == 'check'" :class="message.iconcolor" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg x-show="message.icon == 'exclamation'" :class="message.iconcolor" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg x-show="message.icon == 'warning'" :class="message.iconcolor" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <svg x-show="message.icon == 'happy'" :class="message.iconcolor" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg x-show="message.icon == 'sad'" :class="message.iconcolor" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-slot>
        </x-tall-forms::alpine-alert>
    </template>
    <template x-for="(error, errorIndex) in errors" :key="errorIndex">
        <x-tall-forms::alpine-alert
            x-show="showErrors" xbg="'tf-bg-danger'" xtext="error.replace('form_data.', '')" xcolor="'text-white'" xclick="removeError(error)">
            <x-slot name="icon">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </x-slot>
        </x-tall-forms::alpine-alert>
    </template>
</div>
