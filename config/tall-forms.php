<?php

return [
    //Use cdn links for fields based on third party scripts, or bundle them with your app.js?
    'include-external-scripts' => true,

    // Component attributes, perfect spot to add default Alpine $refs
    'component-attributes' => [
        // You can add anything to these attributes. Applied as $attributes->merge($attr)
        'form' => [
            'class' => 'tf-form',
        ],
        'fields-wrapper' => [
            'class' => 'tf-fields-wrapper'
        ],
    ],

    'form' => [
        'labelW' => 'tf-label-width',
        'fieldW' => 'tf-field-width',
        //Use the field label instead of key, as validation attribute.
        //Recommended, else you have to define language settings for every field. Example: 'form_data.name' => 'Name'
        //Can be overridden per field
        'labelsAsAttributes' => true,
        'notifyErrors' => true, //Alert validation errors, on submit (stacked notifications).
        'wrapWithView' => true,
        'wrapViewPath' => 'tall-forms::wrapper-layout', //A Laravel blade component to wrap your form with, if $wrapWithView = true, see documentation
        'inlineLabelAlignment' => 'tf-inline-label-alignment',
        'formTitle' => '',
        'layout' => 'layouts.app', //Livewire default = 'layouts.app', see https://laravel-livewire.com/docs/2.x/rendering-components#custom-layout
        'slot' => null, // see https://laravel-livewire.com/docs/2.x/rendering-components#custom-layout
        'headView' => '',
        'afterFormView' => '',
        'beforeFormView' => '',
        'formSubtitle' => '',
        'footerView' => '',
        'formFooterTitle' => '',
        'formFooterSubtitle' => '',
        'inline' => true,
        'onKeyDownEnter' => 'saveAndStay', //form submit action
        'showSave' => true,
        'showDelete' => true,
        'showReset' => true,
        'showGoBack' => true,
        'saveStayBtnTxt' => 'tf::form.save-and-stay', //trans('tf::form.save-and-stay')
        'saveBackBtnTxt' => 'tf::form.save-go-back',//trans('tf::form.save-go-back')
        'modalMaxWidth' => 'lg', //options: sm, md, lg, xl, 2xl
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
    //Remove or replace the Aliases.
    'aliases' => [
        'Checkbox' => \Tanthammar\TallForms\Checkbox::class,
        'Checkboxes' => \Tanthammar\TallForms\Checkboxes::class,
        'FileUpload' => \Tanthammar\TallForms\FileUpload::class,
        'ImageCropper' => \Tanthammar\TallForms\ImageCropper::class,
        'Input' => \Tanthammar\TallForms\Input::class,
        'InputArray' => \Tanthammar\TallForms\InputArray::class,
        'MultiSelect' => \Tanthammar\TallForms\MultiSelect::class,
        'Radio' => \Tanthammar\TallForms\Radio::class,
        'Range' => \Tanthammar\TallForms\Range::class,
        'Search' => \Tanthammar\TallForms\Search::class,
        'Select' => \Tanthammar\TallForms\Select::class,
        'SpatieTags' => \Tanthammar\TallForms\SpatieTags::class,
        'Textarea' => \Tanthammar\TallForms\Textarea::class,
        'Trix' => \Tanthammar\TallForms\Trix::class,
        'Tags' => \Tanthammar\TallForms\Tags::class,
        'TagsSearch' => \Tanthammar\TallForms\TagsSearch::class,
        'tfjs' => \Illuminate\Support\Js::class, //Laravel version < 8.75.0 has no alias for this class
    ],


    // list with blade components that this package registers
    // the prefix is 'tall',
    // you cannot change the prefix, but you can replace or extend the components.
    'components' => [
        'form' => \Tanthammar\TallForms\Components\Form::class,
        'label-field-wrapper' => \Tanthammar\TallForms\Components\LabelFieldWrapper::class,
        'field-root' => \Tanthammar\TallForms\Components\FieldRoot::class,
        'input' => \Tanthammar\TallForms\Components\Input::class,
        'input-array' => \Tanthammar\TallForms\Components\InputArray::class,
        'image-cropper' => \Tanthammar\TallForms\Components\ImageCropper::class,
        'range' => \Tanthammar\TallForms\Components\Range::class,
        'textarea' => \Tanthammar\TallForms\Components\Textarea::class,
        'checkbox' => \Tanthammar\TallForms\Components\Checkbox::class,
        'checkboxes' => \Tanthammar\TallForms\Components\Checkboxes::class,
        'radio' => \Tanthammar\TallForms\Components\Radio::class,
        'file-upload' => \Tanthammar\TallForms\Components\FileUpload::class,
        'select' => \Tanthammar\TallForms\Components\Select::class,
        'multiselect' => \Tanthammar\TallForms\Components\MultiSelect::class,
        'search' => \Tanthammar\TallForms\Components\Search::class,
        'trix' => \Tanthammar\TallForms\Components\Trix::class,
        'svg' => \Tanthammar\TallForms\Components\Svg::class,
        'tags' => \Tanthammar\TallForms\Components\Tags::class,
        'tags-search' => \Tanthammar\TallForms\Components\TagsSearch::class,
    ],
];
