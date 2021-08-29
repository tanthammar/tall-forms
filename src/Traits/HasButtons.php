<?php


namespace Tanthammar\TallForms\Traits;


trait HasButtons
{
    public bool $showSave = true;
    public bool $showDelete = true;
    public bool $showReset = true;
    public bool $showGoBack = true;
    public null|string $saveStayBtnTxt = null;
    public null|string $saveBackBtnTxt = null;

    public function saveAndStay()
    {
        $this->submit();
        $this->saveAndStayResponse();
    }

    public function saveAndGoBack()
    {
        $this->submit();
        $this->saveAndGoBackResponse();
    }

    public function resetFormData()
    {
        $this->resetErrorBag();
        $this->setFormProperties();
    }

    public function delete()
    {
        if (optional($this->model)->exists) {
            $this->onDeleteModel();
        }
        return null;
    }

    public function onDeleteModel()
    {
        $className = is_object($this->model) ? get_class($this->model) : "item";
        $this->model->delete();
        session()->flash('success', "The {$className} was deleted");
        return redirect(urldecode($this->previous));
    }

    public function saveAndStayResponse()
    {
        //return redirect()->route('users.create');
        $this->notify();
    }

    public function saveAndGoBackResponse()
    {
        //return back(); //does not work with livewire
        return redirect(urldecode($this->previous));
    }

}
