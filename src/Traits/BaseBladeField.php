<?php

namespace Tanthammar\TallForms\Traits;

class BaseBladeField
{
    protected static array $baseField = [
        'id' => '', //input id
        'name' => null, //input name, falls back to 'id'
        'key' => null, //Livewire property name, falls back to id
        'defer' => true, //defer entangle
        'deferString' => null, //used in Alpine x-data
        'wire' => 'wire:model',
        'xmodel' => 'x-model',
    ];

    public static function setDefaults(array $defaults = [], array $custom = []): object
    {
        //set config values
        self::$baseField['defer'] = config('tall-forms.field-attributes.defer-entangle');
        self::$baseField['wire'] = config('tall-forms.field-attributes.wire');
        self::$baseField['xmodel'] = config('tall-forms.field-attributes.x-model');

        //merge to object
        $field = Helpers::mergeFilledToObject(array_merge(self::$baseField, $defaults), $custom);

        //fall back to id
        $field->name = $field->name ?: $field->id;
        $field->key = $field->key ?: $field->id;

        //handle example: [ 'wire' => 'debounce.300ms' ]
        $field->wire = str_contains($field->wire, 'wire:model') ? $field->wire : "x-model.$field->wire";
        if(str_contains( $field->wire, 'defer')) $field->defer = true;


        //handle example: [ 'xmodel' => 'debounce.300ms' ]
        $field->xmodel = str_contains($field->xmodel, 'x-model') ? $field->xmodel : "x-model.$field->xmodel";
        if (str_contains($field->xmodel, 'defer')) { //x-model.defer does not exist
            $field->defer = true;
            $field->xmodel = 'x-model';
        }

        //defer entangle?
        if($field->defer) $field->deferString = '.defer';

        return $field;
    }

}
