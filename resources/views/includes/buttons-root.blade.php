@if($showDelete || $showReset || $showGoBack || $showSave)
    <div class="tf-buttons-root">
        <div class="tf-buttons-wrapper">
            @if($showDelete && optional($model)->exists)
                <x-tall-button size="sm" wire:click.prevent="delete" color="danger" :text="trans('tf::form.delete')" />
            @endif
            @if($showReset)
                <x-tall-button size="sm" type="reset" wire:click.prevent="resetFormData" color="warning" :text="trans('tf::form.reset')" />
            @endif
            @if($showGoBack)
                <x-tall-button size="sm" wire:click.prevent="saveAndGoBack" color="secondary" :text="$saveBackBtnTxt ?? trans('tf::form.save-go-back')" />
            @endif
            @if($showSave)
                <x-tall-button
                    x-data="{ open: false, errors: {{ json_encode($notifyErrors ? $errors->all() : []) }} }"
                    x-init="$wire.on('notify-saved', () => { open = true; setTimeout(() => { open = false }, 2500); $dispatch('clear-errors'); })"
                    x-on:click="$dispatch( 'replace-errors', {{ json_encode($notifyErrors ? $errors->all() : []) }} )"
                    size="sm" type="submit" color="primary">
                    <span class="mr-2" wire:loading wire:target="{{ $onKeyDownEnter }}">
                        <x-tall-svg path="icons.circle-spinner" class="w-4 h-4 animate-spin -mt-1 fill-current"></x-tall-svg>
                    </span>
                    <span x-show="!open" x-transition:enter.scale.10.delay.500ms>{{ $saveStayBtnTxt ?? trans('tf::form.save-and-stay') }}</span>
                    <span x-cloak x-show="open" x-transition:enter.scale.10.delay.500ms>{{ trans('tf::form.saved') }}</span>
                </x-tall-button>
            @endif
        </div>
    </div>
@endif
