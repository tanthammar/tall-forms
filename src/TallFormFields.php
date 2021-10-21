<?php

namespace Tanthammar\TallForms;

use Livewire\Component;
use Tanthammar\TallForms\Traits\HandlesArrays;

abstract class TallFormFields extends Component
{
    use HandlesArrays; //to handle FileUpload

    public function getFormProperty(): object
    {
        $defaults = config('tall-forms.form');

        return method_exists($this,'formAttr')
            ? (object) array_merge($defaults, $this->formAttr())
            : (object) $defaults;
    }

    public function getComputedFieldsProperty(): array
    {
        return method_exists($this,'fields') ? $this->fields() : [];
    }

    public function render()
    {
        return view('tall-forms::fields-only', [
            'fields' => $this->computedFields,
        ]);
    }

    abstract protected function fields(): array;
}
