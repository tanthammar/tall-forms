<?php

namespace Tanthammar\TallForms;

use Livewire\Component;
use Tanthammar\TallForms\Traits\HandlesArrays;

abstract class TallFormFields extends Component
{
    use HandlesArrays; //to handle FileUpload
    protected array $memoizedFields = [];
    protected object|null $memoizedForm;

    protected function getForm(): object
    {
        if(!is_object($this->memoizedForm)) {
            $defaults = config('tall-forms.form');

            $this->memoizedForm = method_exists($this, 'formAttr')
                ? (object)array_merge($defaults, $this->formAttr())
                : (object)$defaults;
        }
        return $this->memoizedForm;
    }

    protected function getFields(): array
    {
        if ($this->memoizedFields === [] && method_exists($this,'fields')) $this->memoizedFields = $this->fields();
        return $this->memoizedFields;
    }

    public function render()
    {
        return view('tall-forms::fields-only', [
            'fields' => $this->getFields(),
            'form' => $this->getForm(),
        ]);
    }

    abstract protected function fields(): array;
}
