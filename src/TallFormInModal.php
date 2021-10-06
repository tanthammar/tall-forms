<?php

namespace Tanthammar\TallForms;

use Livewire\Component;

abstract class TallFormInModal extends Component
{
    use TallForm;

    public string $closeBtnColor = 'white';
    public string $submitBtnColor = 'primary';

    public bool $modalOpen = false;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->listeners = array_merge($this->listeners, ['loadModal']);
    }

    public function loadModal(int|string $modelKey): void
    {   //on loadModal event
        //$model->id or $model instance
        $this->model = $this->model::find($modelKey) ?? new $this->model;
        $this->resetFormData();
        $this->modalOpen = true;
    }

    //TODO tänk igenom alla classer vad skall vara protected functions
    public function closeModal(): void
    {   //modal cancel button
        $this->modalOpen = false;
        $this->model = new $this->model;
        $this->resetFormData();
    }

    public function modalSubmit(): void
    {   //modal submit button
        $this->saveAndStay();
        $this->modalOpen = false;
    }


    public function getFormProperty(): object
    {
        $defaults = [
            'inline' => false,
            'wrapWithView' => true,
            'wrapViewPath' => 'tall-forms::form-in-modal',
            'submitBtnTxt' => trans('tf::form.save'),
            'cancelBtnTxt' => trans('tf::form.cancel'),
            'onKeyDownEnter' => 'modalSubmit',
            'modalMaxWidth' => 'lg', //options: sm, md, lg, xl, 2xl
        ];

        $defaults = array_merge(config('tall-forms.form'), $defaults);

        return method_exists($this,'formAttr')
            ? (object) array_merge($defaults, $this->formAttr())
            : (object) $defaults;
    }

}
