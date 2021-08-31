<?php
use Tanthammar\TallForms\Components;

return [
    //note that the word dummymodel is auto replaced with the lower case value of --model option in the make command
    'form-title' => "trans('tf::form.create').' '.trans('models.dummymodel.title_singular')",

    //Use the field label instead of key, as validation attribute.
    //Recommended, else you have to define language settings for every field. Example: 'form_data.name' => 'Name'
    //Can be overridden per field
    'field-labels-as-validation-attributes' => true,

    'include-external-scripts' => true, //Use cdn links for fields based on third party scripts, or bundle them with your app.js?

    'notify-validation-errors' => true, //Alert validation errors, on submit (stacked notifications).


    //A Laravel blade component to wrap your form with, if $wrapWithView = true, see documentation
    'wrap-view-path' => 'tall-forms::wrapper-layout',

    // Component attributes, perfect spot to add default Alpine $refs keys
    'component-attributes' => [
        // You can add anything to these attributes. Applied as $attributes->merge($attr)
        'form' => [
            'class' => 'tf-form',
        ],
        'fields-wrapper' => [
            'class' => 'tf-fields-wrapper'
        ],
    ],

    // Field attributes, perfect spot to add default Alpine $refs keys
    'field-attributes' => [
        // You can add anything to these attributes. Applied as $attributes->merge($attr)
        'root' => [
            'class' => 'tf-fields-root' //default = w-full, do not add py-, my- or col-span-x here, see FieldRoot component.
        ],
        'before' => [
            'class' => 'tf-fields-before'
        ],
        'before-text' => [
            'class' => 'tf-fields-before-text'
        ],
        'above' => [
            'class' => 'tf-fields-above'
        ],
        'below' => [
            'class' => 'tf-fields-below'
        ],
        'below-wrapper' => [
            'class' => ''
        ],
        'after' => [
            'class' => 'tf-fields-after'
        ],
        'after-text' => [
            'class' => 'tf-fields-after-text'
        ],

        'wire' => 'wire:model.lazy', //default field wire:model attribute, override with ->wire(...)
        'defer-entangle' => true, //override with ->deferEntangle(bool $state)
    ],

    //You can swap the icons blade view path. The path is relative to resources/views/components
    //(publish the icons: php artisan vendor:publish --tag=tall-form-icons)
    'arrow-up-icon' => 'icons.cheveron-outline-up', //Repeater, Panel
    'arrow-down-icon' => 'icons.cheveron-outline-down',//Repeater, Panel
    'trash-icon' => 'icons.close-outline',//Multiple fields
    'edit-icon' => 'icons.edit-crop', //ImageCropper
    'plus-icon' => 'icons.add-outline',//Repeater
    'file-icon' => 'icons.', //FileUpload field, all icons with "file-" prefix.
    'file-upload' => 'icons.upload', //FileUpload
    'exclamation' => 'icons.exclamation', //Tab, validation errors notification

    //Column span classes for the fields ->colspan() method
    'col-span-classes' => [
        '1' => 'sm:col-span-1',
        '2' => 'sm:col-span-2',
        '3' => 'sm:col-span-3',
        '4' => 'sm:col-span-4',
        '5' => 'sm:col-span-5',
        '6' => 'sm:col-span-6',
        '7' => 'sm:col-span-7',
        '8' => 'sm:col-span-8',
        '9' => 'sm:col-span-9',
        '10' => 'sm:col-span-10',
        '11' => 'sm:col-span-11',
        '12' => 'sm:col-span-12',
    ],

    //Register Aliases for easy access in blade files.
    //Extend or replace the fields.
    'aliases' => [
        'Checkbox' => Tanthammar\TallForms\Checkbox::class,
        'Checkboxes' => Tanthammar\TallForms\Checkboxes::class,
        'FileUpload' => Tanthammar\TallForms\FileUpload::class,
        'ImageCropper' => Tanthammar\TallForms\ImageCropper::class,
        'Input' => Tanthammar\TallForms\Input::class,
        'InputArray' => Tanthammar\TallForms\InputArray::class,
        'MultiSelect' => Tanthammar\TallForms\MultiSelect::class,
        'Radio' => Tanthammar\TallForms\Radio::class,
        'Range' => Tanthammar\TallForms\Range::class,
        'Search' => Tanthammar\TallForms\Search::class,
        'Select' => Tanthammar\TallForms\Select::class,
        'SpatieTags' => Tanthammar\TallForms\SpatieTags::class,
        'Textarea' => Tanthammar\TallForms\Textarea::class,
        'Trix' => Tanthammar\TallForms\Trix::class,
    ],


    // list with blade ui kit components that this package replaces
    // the prefix is 'tall',
    // you cannot change the prefix but you can extend these components,
    // and replace the component classes here.
    'components' => [
        'form' => Components\Form::class,
        'label-field-wrapper' => Components\LabelFieldWrapper::class,
        'field-root' => Components\FieldRoot::class,
        'input' => Components\Input::class,
        'input-array' => Components\InputArray::class,
        'image-cropper' => Components\ImageCropper::class,
        'range' => Components\Range::class,
        'textarea' => Components\Textarea::class,
        'checkbox' => Components\Checkbox::class,
        'checkboxes' => Components\Checkboxes::class,
        'radio' => Components\Radio::class,
        'file-upload' => Components\FileUpload::class,
        'select' => Components\Select::class,
        'multiselect' => Components\MultiSelect::class,
        'search' => Components\Search::class,
        'trix' => Components\Trix::class,
        'svg' => Components\Svg::class,
    ]
];
