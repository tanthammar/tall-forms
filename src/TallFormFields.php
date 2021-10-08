<?php

namespace Tanthammar\TallForms;

use Lean\LivewireAccess\BlockFrontendAccess;
use Lean\LivewireAccess\WithImplicitAccess;
use Livewire\Component;
use Tanthammar\TallForms\Traits\HandlesArrays;

abstract class TallFormFields extends Component
{
    use HandlesArrays, WithImplicitAccess; //to handle FileUpload

    protected object $form;

    public function __construct($id = null)
    {
        $this->form = $this->getForm();
        parent::__construct($id);
    }

    protected function getForm(): object
    {
        $defaults = config('tall-forms.form');

        return method_exists($this,'formAttr')
            ? (object) array_merge($defaults, $this->formAttr())
            : (object) $defaults;
    }

    #[BlockFrontendAccess]
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
