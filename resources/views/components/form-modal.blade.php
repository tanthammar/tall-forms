@props(['id' => null, 'maxWidth' => null, 'submit'])
<x-tall-forms::modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <form wire:submit.prevent="{{ $submit }}">
        @isset($head)
        <div class="tf-modal-form-head">
            {{ $head ?? '' }}
        </div>
        @endisset

        <div class="tf-modal-form-content">
            {{ $content }}
        </div>

        <div class="tf-modal-form-footer">
            {{ $footer }}
        </div>
    </form>
</x-tall-forms::modal>

