<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tanthammar\TallForms\Traits\HandlesArrays;
use Tanthammar\TallForms\Traits\HasButtons;
use Tanthammar\TallForms\Traits\HasComponentDesign;
use Tanthammar\TallForms\Traits\SubmitsForm;
use Tanthammar\TallForms\Traits\Helpers;
use Tanthammar\TallForms\Traits\Notify;
use Tanthammar\TallForms\Traits\ValidatesFields;

trait TallForm
{
    use Notify, Helpers, HandlesArrays, HasComponentDesign, ValidatesFields, SubmitsForm, HasButtons;

    public $model;
    public $form_data;
    public $previous;
    public $showSave = true;
    public $showDelete = true;
    public $showReset = true;
    public $showGoBack = true;
    public $custom_data = [];

    public $labelsAsAttributes;

    public function __construct($id = null)
    {
        $this->listeners = array_merge($this->listeners, ['tallFillField']);
        $this->labelW = 'tf-label-width';
        $this->fieldW = 'tf-field-width';
        $this->labelsAsAttributes = config('tall-forms.field-labels-as-validation-attributes');
        parent::__construct($id);
    }

    public function mount_form($model)
    {
        $this->model = $model;
        $this->beforeFormProperties();
        $this->setFormProperties();
        $this->afterFormProperties();
        $this->previous = urlencode(\URL::previous());  //used for saveAndGoBack
        $this->wrapViewPath = config('tall-forms.wrap-view-path');
        $this->inlineLabelAlignment = $this->inlineLabelAlignment ?? 'tf-inline-label-alignment';
    }


    public function beforeFormProperties()
    {
        return;
    }


    public function setFormProperties()
    {
        $this->form_data = $this->model->only($this->firstLevelfieldNames());

        // foreach ($this->getFields(false) as $field) {
        //     if (filled($field) && !isset($this->form_data[$field->name])) {
        //         $array = in_array($field->type, ['checkboxes', 'file', 'multiselect']);
        //         $this->form_data[$field->name] = $field->default ?? ($array ? [] : null);
        //     }
        // }

        $fields = $this->getFields(false);
        $this->setFormPropertiesRecursively($fields);
    }

    protected function setFormPropertiesRecursively(array $fields)
    {
        foreach ($fields as $field) {
            $fieldKey = str_replace('form_data.', '', $field->key);
            if (filled($field) && false === Str::contains($fieldKey, ['*']) && is_null(data_get($this->form_data, $fieldKey, null))) {
                $array = in_array($field->type, ['checkboxes', 'file', 'multiselect']);
                data_set($this->form_data, $fieldKey, $field->default ?? ($array ? [] : null));
                if (property_exists($field, 'fields') && is_array($field->fields) && 0 < count($field->fields)) {
                    $this->setFormPropertiesRecursively($field->fields);
                }
            }
        }
    }

    public function afterFormProperties()
    {
        return;
    }


    public function getFormTitleProperty()
    {
        return isset($this->formTitle) ? $this->formTitle : $this->formTitle = null;
    }

    //unused property
//    public function getFormWrapperProperty()
//    {
//        return isset($this->formWrapper) ? $this->formWrapper : $this->formWrapper = 'max-w-screen-lg mx-auto';
//    }

    public function render()
    {
        return $this->formView();
    }

    public function formView()
    {
        $view = view('tall-forms::layout-picker', [
            'fields' => $this->getFields(false),
        ]);
        if($this->layout) $view->layout($this->layout);
        return $view;
    }

    public function fields()
    {
        return [];
    }

}
