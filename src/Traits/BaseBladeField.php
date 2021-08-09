<?php

namespace Tanthammar\TallForms\Traits;

use Illuminate\View\Component;

abstract class BaseBladeField extends Component
{
    protected array $baseField = [
        'id' => '', //input id
        'name' => null, //input name, falls back to 'id'
        'key' => null, //Livewire property name, falls back to id
        'defer' => true, //defer entangle
        'deferString' => null, //used in Alpine x-data
        'wire' => 'wire:model',
//        'xmodel' => 'x-model',
        'class' => "", //replace default field->class
        'appendClass' => '', //append to default field->class
        'errorClass' => '', //replace field->class @error
        'appendErrorClass' => 'tf-field-error', //defaults to append field->class @error
    ];

    abstract public function defaults(): array;

    public function __construct(public array|object $field = [])
    {
        $this->buildField($field);
        $this->field->class = $this->class();
        $this->field->errorClass = $this->error();
    }


    protected function buildField(array $custom): void
    {
        //set config values
        $this->baseField['defer'] = config('tall-forms.field-attributes.defer-entangle');
        $this->baseField['wire'] = config('tall-forms.field-attributes.wire');
//        $this->baseField['xmodel'] = config('tall-forms.field-attributes.x-model');

        //merge, base, defaults, custom to Object
        $field = Helpers::mergeFilledToObject(array_merge($this->baseField, $this->defaults()), $custom);

        //fall back to id
        $field->name = $field->name ?: $field->id;
        $field->key = $field->key ?: $field->id;

        $field = $this->wire($field);
//        $field = $this->xmodel($field); //See HasAttributes->xmodel()

        //defer entangle?
        //wire() or xmodel() may set $field->defer
        if ($field->defer) $field->deferString = '.defer';

        $this->field = $field;
    }

    protected function class(): string
    {
        return $this->field->appendClass
            ? Helpers::unique_words("{$this->field->class} {$this->field->appendClass}")
            : $this->field->class;
    }

    protected function error(): string
    {
        return $this->field->appendErrorClass
            ? Helpers::unique_words("{$this->field->class} {$this->field->appendErrorClass}")
            : $this->field->errorClass;
    }

    protected function wire($field): object
    {
        //handle example: [ 'wire' => 'debounce.300ms' ]
        $field->wire = str_contains($field->wire, 'wire:model') ? $field->wire : "wire:model.$field->wire";
        if (str_contains($field->wire, 'defer')) $field->defer = true;
        return $field;
    }

    // See HasAttributes->xmodel()
//    protected function xmodel($field): object
//    {
//        //handle example: [ 'xmodel' => 'debounce.300ms' ]
//        $field->xmodel = str_contains($field->xmodel, 'x-model') ? $field->xmodel : "x-model.$field->xmodel";
//        if (str_contains($field->xmodel, 'defer')) { //x-model.defer does not exist
//            $field->defer = true;
//            $field->xmodel = 'x-model';
//        }
//        return $field;
//    }

}
