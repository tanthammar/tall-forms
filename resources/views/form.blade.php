@php
$rowgap = $inline ? 'sm:row-gap-4 space-y-4' : 'sm:row-gap-3 space-y-3';
@endphp
<div class="w-full">
    @if(!$wrapWithComponent && $this->formTitle) <h3 class="text-2xl my-4">{{ $this->formTitle }}</h3> @endif
    <div class="{{ $this->formWrapper }}">
        <div class="sm:grid sm:col-gap-4 sm:grid-cols-6 sm:space-y-0 {{ $rowgap }}">
            @foreach($fields as $field)
                @if(filled($field))
            <div class="sm:col-span-{{ $field->colspan ?? 6 }}">
                @if($field->view)
                    @include($field->view)
                @elseif($field->livewireComponent)
                    @livewire($field->livewireComponent, $field->livewireParams)
                @else
                    @include('tall-forms::fields.' . $field->type)
                @endif
            </div>
                @endif
            @endforeach
        </div>
        <div class="w-full mt-8 border-t border-gray-200 pt-5">
            <div class="space-x-3 flex justify-center sm:justify-end items-center">
                @if($showDelete)
                <x-button wire:click.prevent="delete" :text="trans(config('tall-forms.delete'))" color="negative" />
                @endif
                <span x-data="{ open: false }" x-init="@this.on('notify-saved', () => { if (open === false) setTimeout(() => { open = false }, 2500); open = true;})" x-show.transition.out.duration.1000ms="open" style="display: none;" class="text-gray-500">{{ trans(config('tall-forms.saved')) }}</span>
                @if($showGoBack)
                <x-button wire:click="saveAndGoBack" color="primary">@lang(config('tall-forms.save-go-back'))</x-button>
                @endif
                <x-button wire:click="saveAndStay" wire:loading.attr="disabled" color="positive">
                    <span class="mr-2" wire:loading wire:target="saveAndStay">
                        <x-tall-spinner /></span>
                    @lang(config('tall-forms.save-and-stay'))
                </x-button>
            </div>
        </div>
    </div>
</div>
