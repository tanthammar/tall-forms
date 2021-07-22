@if($showDelete || $showReset || $showGoBack || $showSave)
    <div class="tf-buttons-root">
        <div class="tf-buttons-wrapper">
            @if($showDelete && optional($model)->exists)
                <x-tall-button size="sm" wire:click.prevent="delete" :text="trans('tf::form.delete')" color="danger"/>
            @endif
            @if($showReset)
                <x-tall-button size="sm" type="reset" wire:click.prevent="resetFormData" :text="trans('tf::form.reset')" color="warning"/>
            @endif
            @if($showGoBack)
                <x-tall-button size="sm" wire:click.prevent="saveAndGoBack" color="secondary">{{ $saveBackBtnTxt ?? trans('tf::form.save-go-back') }}</x-tall-button>
            @endif
            @if($showSave)
                    <span x-data="{ open: false }"
                          x-init="$wire.on('notify-saved', () => { if (open === false) setTimeout(() => { open = false }, 2500); open = true;})"
                          x-show="open" x-transition.out.duration.1000ms style="display: none;"
                          class="text-gray-500">{{ trans('tf::form.saved') }}</span>
                <x-tall-button size="sm" type="submit" wire:click.prevent="saveAndStay" wire:loading.attr="disabled" color="primary">
                        <span class="mr-2" wire:loading wire:target="saveAndStay">
                            <x-tall-spinner/></span>
                    {{ $saveStayBtnTxt ?? trans('tf::form.save-and-stay') }}
                </x-tall-button>
            @endif
        </div>
    </div>
@endif
