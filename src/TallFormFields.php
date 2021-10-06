<?php

namespace Tanthammar\TallForms;


use Illuminate\Auth\Access\AuthorizationException;
use Tanthammar\TallForms\Traits\HandlesArrays;

//TODO skall denna vara abstract?
//TODO gå igenom alla andra som extendas
class TallFormFields extends \Livewire\Component
{
    use HandlesArrays; //to handle FileUpload

    public function getFormProperty(): object
    {
        $defaults = config('tall-forms.form');

        return method_exists($this,'formAttr')
            ? (object) array_merge($defaults, $this->formAttr())
            : (object) $defaults;
    }

    public function render()
    {
        return view('tall-forms::fields-only', [
            'fields' => $this->fields,
        ]);
    }

    //TODO sök efter alla public function fields() ändra till protected
    //TODO gör om till abstract function?
    protected function fields(): array
    {
        return [];
    }
}
