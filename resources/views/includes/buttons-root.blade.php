<div class="tf-buttons-root">
    <div class="tf-buttons-wrapper">
        @if($showDelete && optional($model)->exists)
            <x-tall-button size="sm" wire:click.prevent="delete" :text="trans(config('tall-forms.delete'))" color="danger"/>
        @endif
        @if($showReset)
            <x-tall-button size="sm" type="reset" wire:click.prevent="resetFormData" :text="trans(config('tall-forms.reset'))" color="warning"/>
        @endif
        @if($showGoBack)
            <x-tall-button size="sm" wire:click.prevent="saveAndGoBack" color="secondary">{{ $saveBackBtnTxt ?? trans(config('tall-forms.save-go-back')) }}</x-tall-button>
        @endif
        @if($showSave)
            <span x-data="{ open: false }"
                  x-init="@this.on('notify-saved', () => { if (open === false) setTimeout(() => { open = false }, 2500); open = true;})"
                  x-show.transition.out.duration.1000ms="open" style="display: none;"
                  class="text-gray-500">{{ trans(config('tall-forms.saved')) }}</span>
            <x-tall-button size="sm" type="submit" wire:click.prevent="saveAndStay" wire:loading.attr="disabled" color="primary">
                        <span class="mr-2" wire:loading wire:target="saveAndStay">
                            <x-tall-spinner/></span>
                        {{ $saveStayBtnTxt ?? trans(config('tall-forms.save-and-stay')) }}
            </x-tall-button>
        @endif
    </div>
</div>
