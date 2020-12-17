<?php
use Tanthammar\TallForms\Components;

return [
    //note that the word dummymodel is auto replaced with the lower case value of --model option in the make command
    'form-title' => "trans('global.create').' '.trans('crud.dummymodel.title_singular')",

    //File upload default validation message translation, applied as trans(...) or @lang(...)
    'upload-file-error' => 'messages.file_upload_error', //Example: 'One or many of the uploaded files did not match the allowed filetype or size limit. Please see the fields help text, review your files and try again.'

    //Javascript alerts, used in various fields
    'size-limit-alert' => 'messages.size_limit_alert', //'The file is too large.'
    'one-at-the-time-alert' => 'messages.one_at_the_time_alert', //'Please upload only one file at the time.'
    'max-attachments-alert' => 'messages.max_attachments_alert', //'Max allowed attachments:'
    'mime-alert' => 'messages.mime_alert', //'Invalid file type, please pick another file.'

    //Spatie tags, search input error translation, applied as trans(...) or @lang(...)
    'spatie-tags-search-error' => 'fields.tag_search_error',

    //Use the field label instead of key, as validation attribute.
    //Recommended, else you have to define language settings for every field. Example: 'form_data.name' => 'Name'
    //Can be overridden per field
    'field-labels-as-validation-attributes' => true,

    //Select placeholders and help, applied as trans(...) or @lang(...)
    'select-placeholder' => 'global.select_placeholder', //'Please select an option...'
    'search-placeholder' => 'global.search_placeholder', //'Search ...' //used for both Search and SearchList fields
    'multiselect-placeholder' => 'global.multiselect_placeholder', //'Please select one or multiple options ...'
    'multiselect-help' => 'global.multiselect_help', //'Press CTRL(Windows) or CMD(Mac), to select/deselect multiple options.'


    //A Laravel blade component to wrap your form with, if $wrapWithView = true, see documentation
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


    //You can swap the icons blade view path. The path is relative to resources/views/components
    //(publish the icons: php artisan vendor:publish --tag=tall-form-icons)
    'arrow-up-icon' => 'icons.cheveron-outline-up', //Repeater
    'arrow-down-icon' => 'icons.cheveron-outline-down',//Repeater
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
        'svg' => Components\Svg::class,
    ]
];
