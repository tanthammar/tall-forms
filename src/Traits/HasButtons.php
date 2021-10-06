<?php


namespace Tanthammar\TallForms\Traits;


trait HasButtons
{

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

    //This is called from frontend, delete button
    public function delete()
    {
        if (optional($this->model)->exists) {
            $this->onDeleteModel();
        }
        return null;
    }

    protected function onDeleteModel()
    {
        $this->defaultDelete();
    }

    protected function defaultDelete()
    {
        $className = is_object($this->model) ? get_class($this->model) : "item";
        $this->model->delete();
        session()->flash('success', "The {$className} was deleted");
        return redirect(urldecode($this->previous));
    }

    protected function saveAndStayResponse()
    {
        //example: return redirect()->route('users.create');
        $this->notify();
    }

    protected function saveAndGoBackResponse()
    {
        //return back(); //does not work with livewire
        return redirect(urldecode($this->previous));
    }

}
