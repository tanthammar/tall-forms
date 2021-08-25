<?php

namespace Tanthammar\TallForms;


use Tanthammar\TallForms\Traits\HandlesArrays;

class TallFormFields extends \Livewire\Component
{
    use HandlesArrays; //only for FileUpload

    public bool $inline = true;
    public string $inlineLabelAlignment = 'tf-inline-label-alignment';
    public string $labelW = 'tf-label-width';
    public string $fieldW = 'tf-field-width';

    public function render()
    {
        return view('tall-forms::fields-only', [
            'fields' => $this->fields(),
        ]);
    }

    public function fields(): array
    {
        return [];
    }
}
