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
                    <x-tall-button
                        x-data="{ open: false }"
                        x-on:click="$dispatch('show-errors')"
                        x-on:notify-saved.window="if (open === false) setTimeout(() => { open = false }, 2500); open = true;"
                        @if($errors->any()) disabled @endif
                        size="sm" type="submit" color="primary">
                        <span class="mr-2" wire:loading wire:target="{{ $onKeyDownEnter }}">
                            <x-tall-svg path="icons.circle-spinner" class="w-4 h-4 animate-spin -mt-1 fill-current" />
                        </span>
                        <span x-show="!open" x-transition.out.duration.150ms x-transition.in.duration.150ms>{{ $saveStayBtnTxt ?? trans('tf::form.save-and-stay') }}</span>
                        <span x-show="open" x-transition.out.duration.1000ms style="display: none;" class="text-gray-500">{{ trans('tf::form.saved') }}</span>
                </x-tall-button>
            @endif
        </div>
    </div>
@endif
