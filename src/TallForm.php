<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HandlesArrays;
use Tanthammar\TallForms\Traits\HasButtons;
use Tanthammar\TallForms\Traits\SubmitsForm;
use Tanthammar\TallForms\Traits\MiscMethods;
use Tanthammar\TallForms\Traits\Notify;
use Tanthammar\TallForms\Traits\ValidatesFields;

trait TallForm
{
    use Notify, MiscMethods, HandlesArrays, ValidatesFields, SubmitsForm, HasButtons;

    public $model;
    public array $form_data = [];
    protected string $previous = '';

    public function __construct($id = null)
    {
        //TODO check if there has been a Livewire update that fixes return back().
        $this->previous = urlencode(\URL::previous());  //used for saveAndGoBack
        parent::__construct($id);
    }

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

    protected function mount_form($model)
    {
        $this->model = $model;
        $this->beforeFormProperties();
        $this->setFormProperties();
        $this->afterFormProperties();
    }


    protected function beforeFormProperties()
    {
        return;
    }


    protected function setFormProperties()
    {
        $this->form_data = $this->model->only($this->firstLevelFieldNames());
        $this->setFieldValues($this->getFieldsFlat());
    }

    protected function afterFormProperties()
    {
        return;
    }


    public function render()
    {
        return $this->formView();
    }

    protected function formView()
    {
        $view = view('tall-forms::layout-picker', [
            'fields' => $this->getFieldsNested(),
        ]);
        if (filled($this->form->layout)) $view->layout($this->form->layout);
        if (filled($this->form->slot)) $view->slot($this->form->slot);
        return $view;
    }

    abstract protected function fields(): array;

    protected function transTitle(?string $model = null): string
    {
        $key = $model ?: class_basename($this->model);
        return $this->model->exists
            ? __('tf::form.edit'). ' ' . __("tf::models.$key.singular")
            : __('tf::form.new'). ' ' . __("tf::models.$key.singular");
    }

}
