<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Arr;
use Tanthammar\TallForms\Traits\HandlesArrays;
use Tanthammar\TallForms\Traits\HasComponentDesign;
use Tanthammar\TallForms\Traits\Helpers;
use Tanthammar\TallForms\Traits\Notify;

trait TallForm
{
    use Notify, Helpers, HandlesArrays, HasComponentDesign;

    public $model;
    public $log;
    public $form_data;
    public $previous;
    public $showDelete = true;
    public $showReset = true;
    public $showGoBack = true;
    public $custom_data = [];


    protected $rules = [];

    public function __construct($id = null)
    {
        $this->rules = $this->set_rules();
        $this->listeners = array_merge($this->listeners, ['tallFillField']);
        $this->labelW = config('tall-forms.component-attributes.label-width');
        $this->fieldW = config('tall-forms.component-attributes.field-width');
        parent::__construct($id);
    }


    public function set_rules()
    {
        $rules = [];
        foreach ($this->fields() as $field) {
            if ($field != null) {

                if (!in_array($field->type, ['array', 'keyval', 'file'])) $rules[$field->key] = $field->rules ?? 'nullable';

                if (in_array($field->type, ['array', 'keyval'])) {
                    foreach ($field->fields as $array_field) {
                        $key = $field->type === 'array'
                            ? "$field->key.*.$array_field->name"
                            : "$field->key.$array_field->name";
                        $rules[$key] = $array_field->rules ?? 'nullable';
                    }
                }
                if ($field->type === 'file') { //use field name here, for custom handling
                    $field->multiple
                        ? $rules["$field->name.*"] = $field->rules ?? 'nullable'
                        : $rules[$field->name] = $field->rules ?? 'nullable';
                }
                if ($field->type === 'multiselect') $rules["$field->key.*"] = $field->rules ?? 'nullable';
            }
        }
        return $rules;
    }

    public function mount_form($model)
    {
        $this->model = $model;
        $this->beforeFormProperties();
        $this->setFormProperties();
        $this->afterFormProperties();
        $this->previous = urlencode(\URL::previous());  //used for saveAndGoBack
        $this->wrapComponentName = config('tall-forms.wrap-component-name');
        $this->inlineLabelAlignment = $this->inlineLabelAlignment ?? config('tall-forms.component-attributes.inline-label-alignment');
    }


    public function beforeFormProperties()
    {
        return;
    }


    public function setFormProperties()
    {
        $this->form_data = $this->model->only($this->fieldNames());
        foreach ($this->fields() as $field) {
            if (filled($field) && !isset($this->form_data[$field->name])) {
                $array = in_array($field->type, ['checkboxes', 'file', 'multiselect']);
                $this->form_data[$field->name] = $field->default ?? ($array ? [] : null);
            }
        }
    }

    public function afterFormProperties()
    {
        return;
    }

    public function updated($field, $value)
    {
        $function = $this->parseFunctionNameFrom($field);
        if (method_exists($this, $function)) $this->$function($value);

        $fieldType = $this->getFieldType($field);
        if ($fieldType == 'file') {
            // livewire native file upload
            $this->customValidateFilesIn($field, $this->getFieldValueByKey($field, 'rules'));//this does not work for array keyval fields
        } else {
            $this->validateOnly($field);
        }
    }

    public function submit()
    {
        // fix for Livewire v2.5.5 returning ALL component properties
        // bug: https://github.com/livewire/livewire/issues/1649
        $validated_data = $this->validate()['form_data'];

        $field_names = [];
        $relationship_names = [];
        $custom_names = [];

        foreach ($this->fields() as $field) {
            if (filled($field)) {
                if ($field->is_relation) {
                    $relationship_names[] = $field->name;
                } elseif ($field->is_custom) {
                    $custom_names[] = $field->name;
                } else {
                    $field_names[] = $field->name;
                }
            }
        }

        $relationship_data = Arr::only($validated_data, $relationship_names);
        $this->custom_data = Arr::only($validated_data, $custom_names); //custom_data also used by syncTags(), therefore must be a property
        $model_fields_data = Arr::only($validated_data, $field_names);

        //make sure to create the model before attaching any relations
        $this->success($model_fields_data); //creates or updates the model

        //save relations, group method
        if (filled($this->model) && filled($relationship_data)) {//TODO är det mitt jobb att vara polis?
            $this->relations($relationship_data);
        }

        //save custom fields, group method
        if (filled($this->custom_data)) {
            $this->custom_fields($this->custom_data);
        }

        //saveFoo()
        foreach ($this->fields() as $field) {
            if (filled($field)) {
                $function = $this->parseFunctionNameFrom($field->key, 'save');
                if (method_exists($this, $function)) $this->$function(data_get($validated_data, $field->key));
            }
        }
    }

    public function relations(array $relationship_data)
    {
        //
    }

    public function custom_fields(array $custom_data)
    {
        //
    }

    public function success($model_fields_data)
    {
        // you have to add the methods to your component
        $this->model->exists ? $this->onUpdateModel($model_fields_data) : $this->onCreateModel($model_fields_data);
    }

    public function onUpdateModel($validated_data)
    {
        $this->model->update($validated_data);
    }

    public function onCreateModel($validated_data)
    {
        //
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

    public function getFormTitleProperty()
    {
        return isset($this->formTitle) ? $this->formTitle : $this->formTitle = null;
    }

    public function getFormWrapperProperty()
    {
        return isset($this->formWrapper) ? $this->formWrapper : $this->formWrapper = 'max-w-screen-lg mx-auto';
    }


    public function errorMessage($message, $key='', $label='')
    {
        $return = str_replace('form_data.', '', $message);
        return str_replace('form data.', '', $return);
//        return \Str::replaceFirst('form data.', '', $message);
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

    public function fields()
    {
        return [];
    }

}
