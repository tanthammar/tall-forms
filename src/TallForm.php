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
    protected object|null $memoizedForm;
    protected array $memoizedFields = [];
    protected array $memoizedFieldsNested = [];
    protected array $memoizedFieldsFlat = [];

    public function __construct($id = null)
    {
        //TODO check if there has been a Livewire update that fixes return back().
        $this->previous = urlencode(\URL::previous());  //used for saveAndGoBack
        parent::__construct($id);
    }

    protected function getForm(): object
    {
        if(!is_object($this->memoizedForm)) {
            $defaults = config('tall-forms.form');

            $this->memoizedForm = method_exists($this,'formAttr')
                ? (object) array_merge($defaults, $this->formAttr())
                : (object) $defaults;
        }
        return $this->memoizedForm;
    }

    protected function getFields(): array
    {
        if ($this->memoizedFields === [] && method_exists($this,'fields')) $this->memoizedFields = $this->fields();
        return $this->memoizedFields;
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
        $form = $this->getForm();
        $view = view('tall-forms::layout-picker', [
            'fields' => $this->getFieldsNested(),
            'form' => $form,
        ]);
        if (filled($form->layout)) $view->layout($form->layout);
        if (filled($form->slot)) $view->slot($form->slot);
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
