<?php

namespace Tanthammar\TallForms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TallFormModel extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return config('tall-forms.default-form-factory', \Tanthammar\TallForms\TallFormFactory::new());
    }

    protected static function booted()
    {
        static::creating(function ($tallFormModel) {
            $tallFormModel = self::defaults();
        });
    }

    protected $guarded = [];

    protected $casts = [
        'labelW' => 'string',
        'fieldW' => 'string',
        'labelsAsAttributes' => 'boolean',
        'previous' => 'string', //used for saveAndGoBack btn, dynamically assigned in TallForm->mount_form()
        'notifyErrors' => 'boolean',
        'wrapViewPath' => 'string',
        'inlineLabelAlignment' => 'string',
        'formTitle' => 'string',
        'layout' => 'string',
        'headView' => 'string',
        'afterFormView' => 'string',
        'beforeFormView' => 'string',
        'formSubtitle' => 'string',
        'footerView' => 'string',
        'formFooterTitle' => 'string',
        'formFooterSubtitle' => 'string',
        'inline' => 'boolean',
        'wrapWithView' => 'boolean',
        'onKeyDownEnter' => 'string',
        'showSave' => 'boolean',
        'showDelete' => 'boolean',
        'showReset' => 'boolean',
        'showGoBack' => 'boolean',
        'saveStayBtnTxt' => 'string',
        'saveBackBtnTxt' => 'string',
        'modalMaxWidth' => 'string',
    ];

    public static function defaults(): array
    {
        return [
            'labelW' => 'tf-label-width',
            'fieldW' => 'tf-field-width',
            //Use the field label instead of key, as validation attribute.
            //Recommended, else you have to define language settings for every field. Example: 'form_data.name' => 'Name'
            //Can be overridden per field
            'labelsAsAttributes' => true,
            'notifyErrors' => true, //Alert validation errors, on submit (stacked notifications).
            'wrapViewPath' => 'tall-forms::wrapper-layout', //A Laravel blade component to wrap your form with, if $wrapWithView = true, see documentation
            'inlineLabelAlignment' => 'tf-inline-label-alignment',
            'formTitle' => '',
            'layout' => 'layouts.app', //Livewire default = 'layouts.app'
            'headView' => '',
            'afterFormView' => '',
            'beforeFormView' => '',
            'formSubtitle' => '',
            'footerView' => '',
            'formFooterTitle' => '',
            'formFooterSubtitle' => '',
            'inline' => true,
            'wrapWithView' => true,
            'onKeyDownEnter' => 'saveAndStay', //form submit action
            'showSave' => true,
            'showDelete' => true,
            'showReset' => true,
            'showGoBack' => true,
            'saveStayBtnTxt' => trans('tf::form.save-and-stay'), //trans('tf::form.save-and-stay')
            'saveBackBtnTxt' => trans('tf::form.save-go-back'),//trans('tf::form.save-go-back')
            'modalMaxWidth' => 'lg', //options: sm, md, lg, xl, 2xl
        ];
    }
}

