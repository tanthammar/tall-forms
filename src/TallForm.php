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
    public $form_data;
    public $previous;
    public $custom_data = [];

    public function __construct($id = null)
    {
        $this->previous = urlencode(\URL::previous());  //used for saveAndGoBack
        //SpatieTags is deprecated, if you use it, you have to add this listener manually.
        //$this->listeners = array_merge($this->listeners, ['tallFillField']);
        parent::__construct($id);
    }

    public function getFormProperty(): object
    {
        $defaults = config('tall-forms.form');

        return method_exists($this,'formAttr')
            ? (object) array_merge($defaults, $this->formAttr())
            : (object) $defaults;
    }

    public function getFieldsProperty(): array
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
        if ($this->form->layout) $view->layout($this->form->layout);
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
