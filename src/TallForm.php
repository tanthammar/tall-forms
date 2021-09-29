<?php

namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HandlesArrays;
use Tanthammar\TallForms\Traits\HasButtons;
use Tanthammar\TallForms\Traits\SubmitsForm;
use Tanthammar\TallForms\Traits\Helpers;
use Tanthammar\TallForms\Traits\Notify;
use Tanthammar\TallForms\Traits\ValidatesFields;

trait TallForm
{
    use Notify, Helpers, HandlesArrays, ValidatesFields, SubmitsForm, HasButtons;

    public $model;
    public $form_data;
    public $previous;
    public $custom_data = [];

    public function __construct($id = null)
    {
        $this->previous = urlencode(\URL::previous());  //used for saveAndGoBack
        $this->listeners = array_merge($this->listeners, ['tallFillField']);
        parent::__construct($id);
    }

    public function getFormProperty(): TallFormModel
    {
        return method_exists($this,'formAttr')
            ? TallFormModel::factory()->make($this->formAttr())
            : TallFormModel::factory()->make();
    }

    public function getFieldsProperty(): array
    {
        return method_exists($this,'fields') ? $this->fields() : [];
    }

    public function mount_form($model)
    {
        $this->model = $model;
        $this->beforeFormProperties();
        $this->setFormProperties();
        $this->afterFormProperties();
    }


    public function beforeFormProperties()
    {
        return;
    }


    public function setFormProperties()
    {
        $this->form_data = $this->model->only($this->firstLevelFieldNames());
        $this->setFieldValues($this->getFieldsFlat());
    }

    public function afterFormProperties()
    {
        return;
    }


    public function render()
    {
        return $this->formView();
    }

    public function formView()
    {
        $view = view('tall-forms::layout-picker', [
            'fields' => $this->getFieldsNested(),
        ]);
        if ($this->form->layout) $view->layout($this->form->layout);
        return $view;
    }

    public function fields()
    {
        return [];
    }

    public function transTitle(?string $model = null): string
    {
        $key = $model ?: class_basename($this->model);
        return $this->model->exists
            ? __('tf::form.edit'). ' ' . __("tf::models.$key.singular")
            : __('tf::form.new'). ' ' . __("tf::models.$key.singular");
    }

}
