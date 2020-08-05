<?php

return [
    'form-title' => "trans('global.create').' '.trans('crud.dummymodel.title_singular')",
    //form buttons translations
    'saved' => 'global.saved',
    'delete' => 'global.delete',
    'save-and-stay' =>'global.save',
    'save-go-back' => 'global.save_go_back',
    'message-updated-success' => 'messages.updated_success',
    //notification trait popup bg colors
    'positive' => 'bg-green-500',
    'negative' => 'bg-red-500',
    'info' => 'bg-blue-500',
    'warning' => 'bg-orange-500',
    'default' => 'bg-teal-500',
    //button component classes
    'button-info' => 'text-white bg-frost-dimmed hover:bg-frost-blue focus:border-blue-700 focus:shadow-outline-blue active:bg-frost-dimmed',
    'button-positive' => 'text-white bg-aurora-green hover:bg-green-500 focus:border-green-600 focus:shadow-outline-green active:bg-aurora-green',
    'button-negative' => 'text-red-100 bg-aurora-red hover:bg-red-500 focus:border-red-600 focus:shadow-outline-red active:bg-aurora-red',
    'button-warning' => 'text-orange-100 bg-aurora-orange hover:bg-orange-600 focus:border-orange-700 focus:shadow-outline-orange active:bg-orange-700',
    'button-primary' => 'text-blue-100 bg-night-lighter hover:bg-night-dark focus:border-night-light focus:shadow-outline-blue active:bg-night-dark',
    //file uploads
    'storage_disk' => env('FORM_STORAGE_DISK', 'public'),
    'storage_path' => env('FORM_STORAGE_PATH', 'uploads'),
    //icons
    'arrow-up-icon' => 'light/arrow-up', //used as @svg('light/arrow-up', 'classes')
    'arrow-down-icon' => 'light/arrow-down',
    'trash-icon' => 'light/trash-alt',
    'plus-icon' => 'light/plus-circle',
    'file-icon' => 'light/' //used as light/{$mime_type}
];
