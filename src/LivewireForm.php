<?php

namespace Tanthammar\TallForms;

trait LivewireForm

{
    public $model;
    public $wrapWithComponent = false;
    public $wrapComponentName;
    public $previous;
    public $inline = true;
    public $showDelete = false;
    public $showGoBack = true;


    protected $rules = [];

    public function __construct($id = null)
    {
        $this->rules = $this->set_rules();
        parent::__construct($id);
    }

    public function set_rules()
    {
        $rules = [];
        foreach ($this->fields() as $field) {
            if ($field != null) {

                if (!in_array($field->type, ['array', 'keyval'])) $rules['model.' . $field->key] = $field->rules ?? 'nullable';

                if (in_array($field->type, ['array', 'keyval'])) {
                    foreach ($field->fields as $array_field) {
                        $key = $field->type === 'array'
                            ? 'model.' . $field->key . '.*.' . $array_field->key
                            : 'model.' . $field->key . '.' . $array_field->key;
                        $rules[$key] = $array_field->rules;
                    }
                }
            }
        }
        return $rules;
    }

    public function mount_form($model)
    {
        $this->model = $model;
        $this->previous = urlencode(\URL::previous());  //used for saveAndGoBack
        $this->wrapComponentName = config('tall-forms.wrap-component-name');
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function submit()
    {
        $validated_data = $this->validate();
        dd($validated_data);
        $this->model->exist ? $this->model->save() : $this->create($validated_data['model']);
        //return redirect
    }

    public function getFormTitleProperty()
    {
        return isset($this->formTitle) ? $this->formTitle : $this->formTitle = null;
    }

    public function getFormWrapperProperty()
    {
        return isset($this->formWrapper) ? $this->formWrapper : $this->formWrapper = 'max-w-screen-lg mx-auto';
    }


    public function cleanMessage($message)
    {
        return \Str::replaceFirst('model.', '', $message);
    }

    public function render()
    {
        return $this->formView();
    }

    public function formView()
    {
        return view('tall-forms::layout-picker', [
            'fields' => $this->fields(),
        ]);
    }

}
