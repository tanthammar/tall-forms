<?php


namespace Tanthammar\TallForms\Traits;


use Illuminate\Support\Arr;

trait SubmitsForm
{

    public function submit()
    {
        $validated_data = $this->validate($this->get_rules())['form_data'];
        // dd($this->form_data);

        $groupedFieldNames = collect($this->getFields())->mapToGroups(function ($item) {
            $indexName = 'field_names';
            if ($item->is_custom) $indexName = 'custom_names';
            if ($item->is_relation) $indexName = 'relationship_names';
            $fieldName = str_replace(['form_data.', '*.'], '', $item->key);
            return [$indexName => $fieldName];
        })->toArray();

        $relationship_data = $this->arrayDotOnly($validated_data, $groupedFieldNames['relationship_names'] ?? []);
        $this->custom_data = $this->arrayDotOnly($validated_data, $groupedFieldNames['custom_names'] ?? []); //custom_data also used by syncTags(), therefore must be a property
        $model_fields_data = $this->arrayDotOnly($validated_data, $groupedFieldNames['field_names'] ?? []);

        //make sure to create the model before attaching any relations
        $this->success($model_fields_data); //creates or updates the model

        //saveFoo()
        foreach ($this->getFields() as $field) {
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
