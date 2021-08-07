<x-tall-input
    :field="$field->mergeBladeDefaults($_instance->id, [
        'prefix' => $field->prefix,
        'icon' => $field->icon, //Blade icon name
        'iconClass' => $field->iconClass, //Blade icon class
        'tallIcon' => $field->tallIcon,
        'htmlIcon' => $field->htmlIcon,
        'type' => $field->input_type,
        'suffix' => $field->suffix,
        'sfxIcon' => $field->sfxIcon, //Blade icon name
        'sfxIconClass' => $field->sfxIconClass, //Blade icon class
        'sfxTallIcon' => $field->sfxTallIcon, //Tall-forms icon name
        'sfxHtmlIcon' => $field->sfxHtmlIcon, //Html example: <i>...</i>
        'autocomplete' => $field->autocomplete,
        'placeholder' => $field->placeholder,
        'step' => $field->step,
        'min' => $field->min,
        'max' => $field->max,
    ])"
    :attr="array_merge([
        $field->wire => $field->key
    ], $field->getAttr('input'))
"/>
