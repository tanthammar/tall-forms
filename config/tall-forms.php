<?php
use Tanthammar\TallForms\Components;

return [
    //note that the word dummymodel is auto replaced with the lower case value of --model option in the make command
    'form-title' => "trans('global.create').' '.trans('crud.dummymodel.title_singular')",
    'field-labels-as-validation-attributes' => true,

    // Component attributes
    'component-attributes' => [
        // You can add anything to these attributes. Applied as @foreach($attr as key => value)
        'form' => [
            'class' => 'w-full',
        ],
        'fields-wrapper' => [
            'class' => 'max-w-screen-lg mx-auto divide-gray-200 divide-y sm:grid sm:grid-cols-12'
        ],
        //these are not applied as foreach, you can only set the class attribute here
        'form-head' => '',
        'form-title' => 'text-lg leading-6 font-medium text-gray-900',
        'form-sub-title' => 'mt-1 max-w-2xl text-sm leading-5 text-gray-500',
        'form-footer' => 'border rounded sm:p-4',
        'form-footer-title' => 'text-lg leading-6 font-medium text-gray-900',
        'form-footer-sub-title' => 'mt-1 max-w-2xl text-sm leading-5 text-gray-500',
        'help' => 'leading-tight text-gray-500 text-sm',
        'error' => 'italic leading-tight text-gray-500 text-red-500 text-sm',
        'buttons-root' => 'w-full border-t border-gray-200 pt-5',
        'buttons-wrapper' => 'flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3 sm:justify-end sm:items-center',
        'inline-label-alignment' => 'text-left',
        'stacked-label-alignment' => 'text-left',
        //Default label-, field-width for inline form layout
        'label-width' => 'sm:w-1/3 md:w-1/5',
        'field-width' => 'sm:w-2/3 md:w-4/5',
        'tags-color' => 'bg-blue-100 text-blue-800'
    ],

    // Field attributes
    'field-attributes' => [
        // You can add anything to these attributes. Applied as @foreach($attr as key => value)
        'root' => [
            'class' => 'w-full' //do not add py-, my- or col-span-x here, see FieldRoot component.
        ],
        'before' => [
            'class' => 'my-4 w-full border border-gray-200'
        ],
        'before-text' => [
            'class' => 'block text-sm leading-5 text-gray-700 p-2'
        ],
        'above' => [
            'class' => 'leading-4 text-gray-500 text-sm sm:pt-1'
        ],
        'below' => [
            'class' => 'leading-tight text-gray-500 text-sm'
        ],
        'below-wrapper' => [
            'class' => ''
        ],
        'after' => [
            'class' => 'my-4 w-full border border-gray-200'
        ],
        'after-text' => [
            'class' => 'block text-sm leading-5 text-gray-700 p-2'
        ],
        //these are not applied as foreach, you can only set the class attribute here
        'label-field-wrapper-inline' => 'sm:flex',
        'label-field-wrapper-stacked' => 'w-full',
        'label' => 'my-1 block text-sm font-medium leading-5 text-gray-700',
        'label-suffix' => 'italic text-black text-opacity-25 text-xs',
        'after-label' => '-mt-1 block text-sm leading-4 text-gray-700',
        'input' => 'my-1 flex rounded-md shadow-sm w-full relative',
        'range-value' => 'rounded border px-2 font-medium',
        'keyval-wrapper' => 'flex flex-col',
        'keyval-wrapper-grid' => 'sm:flex sm:grid sm:grid-cols-12 sm:gap-x-2 sm:gap-y-4',
        'repeater-wrapper' => 'flex flex-col divide-y mb-2 rounded border',
        'repeater-wrapper-grid' => 'flex-1 sm:grid sm:grid-cols-12 gap-x-2',
    ],

    //A Laravel 7 blade component to wrap your form if $spaMode = true, see documentation
    'wrap-view-path' => 'tall-forms::wrapper-layout',


    //form buttons translations
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


    //notification trait popup bg colors
    'positive' => 'bg-green-500',
    'negative' => 'bg-red-500',
    'info' => 'bg-blue-500',
    'warning' => 'bg-orange-500',
    'default' => 'bg-teal-500',

    //text colors
    'text-positive' => 'text-aurora-green',
    'text-negative' => 'text-aurora-red',
    'text-info' => 'text-frost-dimmed',
    'text-warning' => 'text-orange-800',
    'text-primary' => 'text-teal-800',


    //button component classes
    'button-info' => 'text-white bg-frost-dimmed hover:bg-frost-blue focus:border-blue-700 focus:shadow-outline-blue active:bg-frost-dimmed',
    'button-positive' => 'text-white bg-aurora-green hover:bg-green-500 focus:border-green-600 focus:shadow-outline-green active:bg-aurora-green',
    'button-negative' => 'text-red-100 bg-aurora-red hover:bg-red-500 focus:border-red-600 focus:shadow-outline-red active:bg-aurora-red',
    'button-warning' => 'text-orange-100 bg-aurora-orange hover:bg-orange-600 focus:border-orange-700 focus:shadow-outline-orange active:bg-orange-700',
    'button-primary' => 'text-blue-100 bg-night-lighter hover:bg-night-dark focus:border-night-light focus:shadow-outline-blue active:bg-night-dark',



    //icons
    'arrow-up-icon' => 'light/arrow-up', //used as @svg('light/arrow-up', 'classes')
    'arrow-down-icon' => 'light/arrow-down',
    'trash-icon' => 'light/trash-alt',
    'plus-icon' => 'light/plus-circle',
    'file-icon' => 'light/', //used as @svg('light/{$mime_type}', 'classes')
    'file-upload' => 'light/upload', //prefix icon for file upload field

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

    //File upload default validation message
    'upload-file-error' => 'messages.file_upload_error', //Example: 'One or many of the uploaded files did not match the allowed filetype or size limit. Please see the fields help text, review your files and try again.'


    //Spatie tags, search input error
    'spatie-tags-search-error' => 'fields.tag_search_error',


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
