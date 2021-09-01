<?php

namespace Tanthammar\TallForms;


use Illuminate\Auth\Access\AuthorizationException;
use Tanthammar\TallForms\Traits\HandlesArrays;

class TallFormFields extends \Livewire\Component
{
    use HandlesArrays; //to handle FileUpload

    public function getFormProperty(): TallFormModel
    {
        return method_exists($this,'formAttr')
            ? TallFormModel::factory()->make($this->formAttr())
            : TallFormModel::factory()->make();
    }

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
