<?php

namespace Tanthammar\TallForms;

abstract class TallFormInModal extends \Livewire\Component
{
    use TallForm;

    public string $closeBtnColor = 'danger';
    public string $submitBtnColor = 'success';

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


    public function getFormProperty(): TallFormModel
    {
        $defaults = [
            'inline' => false,
            'wrapWithView' => true,
            'wrapViewPath' => 'tall-forms::form-in-modal',
            'submitBtn' => trans('tf::form.save'),
            'cancelBtn' => trans('tf::form.cancel'),
            'onKeyDownEnter' => 'modalSubmit',
            'modalMaxWidth' => 'lg', //options: sm, md, lg, xl, 2xl
        ];

        return method_exists($this, 'formAttr')
            ? TallFormModel::factory()->make(array_merge($defaults, $this->formAttr()))
            : TallFormModel::factory()->make($defaults);
    }

}
