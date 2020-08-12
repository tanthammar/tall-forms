<?php

namespace Tanthammar\TallForms;

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
    public $action = 'update';
    public $formTitle;
    public $showDelete = false;
    public $showGoBack = true;
    public $inline = true;
    public $spaMode = false;
    public $spaLayout;
    private static $storage_disk;
    private static $storage_path;
    public $form_wrapper = 'max-w-screen-lg mx-auto';
    public $previous;

    protected $listeners = ['fileUpdate'];

    public function mount_form($model = null)
    {
        $this->model = $model;
        $this->beforeFormProperties();
        $this->setFormProperties($this->model);
        $this->afterFormProperties();
        $this->previous = \URL::previous();  //used for saveAndGoBack
        $this->spaLayout = config('tall-forms.spa-layout');
    }


    public function beforeFormProperties()
    {
        return;
    }


    public function setFormProperties($model = null)
    {
        if ($model) $this->form_data = $model->toArray();
        foreach ($this->fields() as $field) {
            if (filled($field) && !isset($this->form_data[$field->name])) {
                $array = in_array($field->type, ['checkboxes', 'file']);
                $this->form_data[$field->name] = $field->default ?? ($array ? [] : null);
            }
        }
    }

    public function afterFormProperties()
    {
        return;
    }

    //legacy method from v1
    public function setup()
    {
        $this->formTitle = '';
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
        $this->fields_updated($field);
        $this->validateOnly($field, $this->rules(true));
    }

    public function fields_updated($field)
    {
        return null;
    }

    public function submit()
    {
        $this->validate($this->rules());

        $field_names = [];
        $relationship_names = [];
        $custom_names = [];

        foreach ($this->fields() as $field) {
            if ($field->is_relation) {
                $relationship_names[] = $field->name;
            } elseif ($field->is_custom) {
                $custom_names[] = $field->name;
            } else {
                $field_names[] = $field->name;
            }
        }

        $relationship_data = Arr::only($this->form_data, $relationship_names);
        $custom_data = Arr::only($this->form_data, $custom_names);
        $this->form_data = Arr::only($this->form_data, $field_names);

        //make sure to create the model before attaching any relations
        $this->success(); //creates or updates the model
        if (filled($this->model)) $this->relations($relationship_data);
        $this->custom_fields($custom_data);
    }

    public function errorMessage($message)
    {
        return str_replace('form data.', '', $message);
    }

    public function success()
    {
        ($this->action == 'update')
            ? $this->model->update($this->form_data)
            : $this->create($this->form_data);
    }

    public function relations(array $relationship_data)
    {
        return;
    }

    public function custom_fields(array $custom_data)
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
