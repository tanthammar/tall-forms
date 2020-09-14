<div class="{{ $this->getAttr('buttons-root') }}">
    <div class="{{ $this->getAttr('buttons-wrapper') }}">
        @if($showDelete && $model->exists)
            <x-tall-button wire:click.prevent="delete" :text="trans(config('tall-forms.delete'))" color="negative"/>
        @endif
        @if($showReset)
            <x-tall-button type="reset" wire:click.prevent="resetFormData" :text="trans(config('tall-forms.reset'))" color="warning"/>
        @endif
        <span x-data="{ open: false }"
              x-init="@this.on('notify-saved', () => { if (open === false) setTimeout(() => { open = false }, 2500); open = true;})"
              x-show.transition.out.duration.1000ms="open" style="display: none;"
              class="text-gray-500">{{ trans(config('tall-forms.saved')) }}</span>
        @if($showGoBack)
            <x-tall-button wire.click.prevent="saveAndGoBack"
                      color="primary">@lang(config('tall-forms.save-go-back'))</x-tall-button>
        @endif
        <x-tall-button type="submit" wire:click.prevent="saveAndStay" wire:loading.attr="disabled" color="positive">
                    <span class="mr-2" wire:loading wire:target="saveAndStay">
                        <x-tall-spinner/></span>
            @lang(config('tall-forms.save-and-stay'))
        </x-tall-button>
    </div>
</div>
