<?php


namespace Tanthammar\TallForms\Traits;


use Illuminate\Support\Arr;

trait SubmitsForm
{

    public function submit()
    {
        $validated_data = $this->validate($this->get_rules())['form_data'];
        $field_names = [];
        $custom_names = [];

        foreach ($this->fields() as $field) {
            if (filled($field)) {
                if ($field->is_custom) $custom_names[] = $field->name;
                if (!$field->is_relation && !$field->is_custom) $field_names[] = $field->name;
            }
        }

        $this->custom_data = Arr::only($validated_data, $custom_names); //custom_data also used by syncTags(), therefore must be a property
        $model_fields_data = Arr::only($validated_data, $field_names);

        //make sure to create the model before attaching any relations
        $this->success($model_fields_data); //creates or updates the model

        //saveFoo()
        foreach ($this->fields() as $field) {
            if (filled($field)) {
                $function = $this->parseFunctionNameFrom($field->key, 'save');
                $validated_data = $field->type == 'file' ? $this->{$field->name} : data_get($this, $field->key);
                if (method_exists($this, $function)) $this->$function($validated_data);
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
        filled($this->model) && $this->model->exists ? $this->onUpdateModel($model_fields_data) : $this->onCreateModel($model_fields_data);
    }

    public function onUpdateModel($validated_data)
    {
        $this->model->update($validated_data);
    }

    public function onCreateModel($validated_data)
    {
        //
    }
}
