@if($form->showDelete || $form->showReset || $form->showGoBack || $form->showSave)
    <div class="tf-buttons-root">
        <div class="tf-buttons-wrapper">
            @if($form->showDelete && optional($model)->exists)
                <x-tall-button size="sm" wire:click.prevent="delete" color="danger" :text="trans('tf::form.delete')" />
            @endif
            @if($form->showReset)
                <x-tall-button size="sm" type="reset" wire:click.prevent="resetFormData" color="warning" :text="trans('tf::form.reset')" />
            @endif
            @if($form->showGoBack)
                <x-tall-button size="sm" wire:click.prevent="saveAndGoBack" color="secondary" :text="trans($form->saveBackBtnTxt)" />
            @endif
            @if($form->showSave)
                <x-tall-button
                    x-data="{ open: false }"
                    x-init="$wire.on('notify-saved', () => { open = true; setTimeout(() => { open = false }, 2500); $dispatch('clear-errors'); })"
                    size="sm" type="submit" color="primary" x-on:click="$dispatch( 'replace-errors', JSON.parse(atob('{{ base64_encode(json_encode($form->notifyErrors ? $errors->all() : [])) }}')) )"  >
                    <span class="mr-2" wire:loading wire:target="{{ $form->onKeyDownEnter }}">
                        <x-tall-svg path="icons.circle-spinner" class="w-4 h-4 animate-spin -mt-1 fill-current"></x-tall-svg>
                    </span>
                    <span x-show="!open" x-transition:enter.scale.10.delay.500ms>@lang($form->saveStayBtnTxt)</span>
                    <span x-cloak x-show="open" x-transition:enter.scale.10.delay.500ms>{{ trans('tf::form.saved') }}</span>
                </x-tall-button>
            @endif
        </div>
    </div>
@endif
