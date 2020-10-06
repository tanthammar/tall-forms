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

    public function delete()
    {
        if (optional($this->model)->exists) {
            $this->model->delete();
            session()->flash('success', 'The object was deleted');
            return redirect(urldecode($this->previous));
        }
        return null;
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
