<x-tall-forms::form-modal
    wire:model="modalOpen"
    :id="'modal'.md5($_instance->id.'modalOpen')"
    :submit="$this->form->onKeyDownEnter"
    :maxWidth="$this->form->modalMaxWidth">

    @if($this->form->formTitle | $this->form->formSubtitle)
    <x-slot name="head">
        <h1 class="tf-modal-form-title">
            {{ $this->form->formTitle }}
        </h1>
        <p class="tf-modal-form-sub-title">
            {{ $this->form->formSubtitle }}
        </p>
    </x-slot>
    @endif

    <x-slot name="content">
        @if($this->form->beforeFormView)
            @include($this->form->beforeFormView)
        @endif
        @if(isset($isTabs) && $isTabs)
            @include('tall-forms::fields.tabs')
        @else
            @include('tall-forms::includes.field-loop')
        @endif
        @include('tall-forms::includes.form-footer')
        @if($this->form->afterFormView)
            @include($this->form->afterFormView)
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-tall-button
            size="sm" color="{{ $closeBtnColor }}"
            wire:click.prevent.stop="closeModal"
            wire:loading.attr="disabled"
            :text="$this->form->cancelBtn" />

        <x-tall-button
            size="sm" class="ml-2" type="submit" color="{{ $submitBtnColor }}"
            wire:click="{{ $this->form->onKeyDownEnter }}"
            wire:loading.attr="disabled"
            :text="$this->form->submitBtn" />
    </x-slot>

</x-tall-forms::form-modal>
