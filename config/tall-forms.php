<?php
use Tanthammar\TallForms\Components;

return [
    //note that the word dummymodel is auto replaced with the lower case value of --model option in the make command
    'form-title' => "trans('global.create').' '.trans('crud.dummymodel.title_singular')",

    //File upload default validation message translation, applied as trans(...) or @lang(...)
    'upload-file-error' => 'messages.file_upload_error', //Example: 'One or many of the uploaded files did not match the allowed filetype or size limit. Please see the fields help text, review your files and try again.'

    //Spatie tags, search input error translation, applied as trans(...) or @lang(...)
    'spatie-tags-search-error' => 'fields.tag_search_error',

    'field-labels-as-validation-attributes' => true,

    //A Laravel 7 blade component to wrap your form if $spaMode = true, see documentation
    'wrap-view-path' => 'tall-forms::wrapper-layout',

    // Component attributes, perfect spot to add default Alpine $refs keys
    'component-attributes' => [
        // You can add anything to these attributes. Applied as @foreach($attr as key => value)
        'form' => [
            'class' => 'tf-form',
        ],
        'fields-wrapper' => [
            'class' => 'tf-fields-wrapper'
        ],
    ],

    // Field attributes, perfect spot to add default Alpine $refs keys
    'field-attributes' => [
        // You can add anything to these attributes. Applied as @foreach($attr as key => value)
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
        //default field wire:model attribute
        'wire' => 'wire:model.lazy',
    ],




    //form buttons translations applied as trans(...) or @lang(...)
    'saved' => 'global.saved',
    'save' => 'global.save',
    'swap' => 'global.swap',
    'delete' => 'global.delete',
    'edit' => 'global.edit',
    'reset' => 'global.reset',
    'save-and-stay' => 'global.save',
    'save-go-back' => 'global.save_go_back',
    'message-updated-success' => 'messages.updated_success',
    'are-u-sure' => 'global.areYouSure',


    //icons, used as @svg('path/file-name', 'classes')
    'arrow-up-icon' => 'tall-forms/cheveron-outline-up',
    'arrow-down-icon' => 'tall-forms/cheveron-outline-down',
    'trash-icon' => 'tall-forms/close-outline',//Multiple fields
    'edit-icon' => 'tall-forms/edit-crop', //ImageCropper
    'plus-icon' => 'tall-forms/add-outline',//Repeater
    'file-icon' => 'tall-forms/', //FileUpload, used as @svg('tall-forms/{$mime_type}', 'classes')
    'file-upload' => 'tall-forms/upload', //FileUpload

    //Column span classes for the fields ->colspan() method
    //requires tailwind css v1.7.0
    //see tailwind.config.js future:{}
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


    // list with blade ui kit components that this package replaces
    // the prefix is 'tall',
    // you cannot change the prefix but you can extend these components,
    // and replace the component classes here.
    'components' => [
        'form' => Components\Form::class,
        'label-field-wrapper' => Components\LabelFieldWrapper::class,
        'field-root' => Components\FieldRoot::class,
        'input' => Components\Input::class,
        'image-cropper' => Components\ImageCropper::class,
        'range' => Components\Range::class,
        'textarea' => Components\Textarea::class,
        'checkbox' => Components\Checkbox::class,
        'checkboxes' => Components\Checkboxes::class,
        'radio' => Components\Radio::class,
        'file-upload' => Components\FileUpload::class,
        'select' => Components\Select::class,
        'search' => Components\Search::class,
        'trix' => Components\Trix::class,
    ]
];
