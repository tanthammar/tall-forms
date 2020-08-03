<?php

namespace Tanthammar\TallForms;

use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Tanthammar\TallForms\Traits\FollowsRules;
use Tanthammar\TallForms\Traits\HandlesArrays;
use Tanthammar\TallForms\Traits\Notify;
use Tanthammar\TallForms\Traits\UploadsFiles;
use Livewire\Component;

class FormComponent extends Component
{
    use FollowsRules, UploadsFiles, HandlesArrays, Notify;

    public $model;
    public $form_data;
    public $action;
    public $formTitle;
    public $showDelete = false;
    public $showGoBack = true;
    public $inline = true;
    public $spaMode = false;
    public $spaLayout = 'tall-forms::spa-layout';
    private static $storage_disk;
    private static $storage_path;
    public $form_wrapper = 'max-w-screen-lg mx-auto';
    public $previous;

    protected $listeners = ['fileUpdate'];

    public function mount($model = null, $action = 'update', $showDelete = false)
    {
        $this->model = $model;
        $this->beforeFormProperties();
        $this->setFormProperties($model);
        $this->action = $action;
        $this->showDelete = $showDelete;
        $this->setup();
        $this->previous = \URL::previous();  //used for saveAndGoBack
    }

    public function beforeFormProperties()
    {
        return;
    }

    public function setFormProperties($model = null)
    {
        if ($model) $this->form_data = $model->toArray();
        foreach ($this->fields() as $field) {
            if (!isset($this->form_data[$field->name])) {
                $array = in_array($field->type, ['checkbox', 'file']);
                $this->form_data[$field->name] = $field->default ?? ($array ? [] : null);
            }
        }
    }

    public function setup() {
        $this->fill([
            'formTitle' => 'create DummyModel',
            'action' => 'update',
        ]);
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

    public function fields()
    {
        return [
            Field::make('Name')->input()->rules(['required', 'string', 'max:255']),
            Field::make('Email')->input('email')->rules(['required', 'string', 'email', 'max:255', 'unique:users,email']),
            Field::make('Password')->input('password')->rules(['required', 'string', 'min:8', 'confirmed']),
            Field::make('Confirm Password', 'password_confirmation')->input('password'),
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules(true));
    }

    public function submit()
    {
        $this->validate($this->rules());

        $field_names = [];
        $relationship_names = [];
        foreach ($this->fields() as $field) {
            ($field->is_relation) ? $relation_names[] = $field->name : $field_names[] = $field->name;
        }
        $this->form_data = Arr::only($this->form_data, $field_names);
        $this->success();
        filled($relationship_data = Arr::only($this->form_data, $relationship_names)) ? $this->relations($relationship_data) : null;
    }

    public function errorMessage($message)
    {
        return str_replace('form data.', '', $message);
    }

    public function success()
    {
        // $this->form_data['password'] = bcrypt($this->form_data['password']);
        // \App\Models\User::create($this->form_data);
        ($this->action == 'update')
            ? $this->model->update($this->form_data)
            : $this->create($this->form_data);
    }

    public function relations(array $relationship_data)
    {
        return;
    }

    public function create($form_data)
    {
        return;
    }


    public function delete()
    {
        if (optional($this->model)->exists) {
            $this->model->delete();
            session()->flash('success', 'The object was deleted');
            return redirect($this->previous);
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
        return redirect($this->previous);
    }

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
}
