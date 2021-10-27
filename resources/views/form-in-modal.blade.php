<x-tall-forms::form-modal
    wire:model="modalOpen"
    :id="'modal'.md5($_instance->id.'modalOpen')"
    :submit="$form->onKeyDownEnter"
    :maxWidth="$form->modalMaxWidth">

    @if($form->formTitle | $form->formSubtitle)
    <x-slot name="head">
        <h1 class="tf-modal-form-title">
            {{ $form->formTitle }}
        </h1>
        <p class="tf-modal-form-sub-title">
            {{ $form->formSubtitle }}
        </p>
    </x-slot>
    @endif

    <x-slot name="content">
        @if($form->beforeFormView)
            @include($form->beforeFormView)
        @endif
        @if(isset($isTabs) && $isTabs)
            @include('tall-forms::fields.tabs')
        @else
            @include('tall-forms::includes.field-loop')
        @endif
        @include('tall-forms::includes.form-footer')
        @if($form->afterFormView)
            @include($form->afterFormView)
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-tall-button
            size="sm" color="{{ $this->closeBtnColor }}"
            wire:click.prevent.stop="closeModal"
            wire:loading.attr="disabled"
            :text="$form->cancelBtnTxt" />

        <x-tall-button
            size="sm" class="ml-2" type="submit" color="{{ $this->submitBtnColor }}"
            wire:click="{{ $form->onKeyDownEnter }}"
            wire:loading.attr="disabled"
            :text="$form->submitBtnTxt" />
    </x-slot>

</x-tall-forms::form-modal>
