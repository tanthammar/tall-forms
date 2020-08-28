<?php

namespace Tanthammar\TallForms\Traits;


trait LivewireForm
{
    public $entity;
    public $spaMode = false;
    public $spaLayout;
    public $previous;
    public $inline = true;
    public $showDelete = false;
    public $showGoBack = true;




    public function mount_form()
    {
        $this->entity = $this->beforeFirstDot(array_key_first($this->rules));
        $this->previous = urlencode(\URL::previous());  //used for saveAndGoBack
        $this->spaLayout = config('tall-forms.spa-layout');
    }

    public function getFormTitleProperty()
    {
        return isset($this->formTitle) ? $this->formTitle : $this->formTitle = null;
    }

    public function getFormWrapperProperty()
    {
        return isset($this->formWrapper) ? $this->formWrapper : $this->formWrapper = 'max-w-screen-lg mx-auto';
    }

    public function save()
    {
        $validated_data = $this->validate();
        $model = $this->entity;
        $this->$model->exist ? $this->$model->save() : $this->create($validated_data[$this->entity]);
        //return redirect
    }

    public function cleanMessage($message)
    {
        return \Str::replaceFirst($this->entity.'.', '', $message);
    }

    public function render()
    {
        return $this->formView();
    }

    public function formView()
    {
        return view('tall-forms::form', [
            'fields' => $this->fields(),
        ]);
    }

}
