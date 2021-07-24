@php $alpineKey = $field->alpineKey ?? 'input'; @endphp
<x-tall-input :field="[
        'name' => $field->getHtmlId($_instance->id), //id falls back to name
        'key' => $field->key, //@error & Livewire prop
        'wrapperClass' => $field->wrapperClass,
        'class' => $field->class,
        'prefix' => $field->prefix,
        'icon' => $field->icon, //Blade icon name
        'iconClass' => $field->iconClass, //Blade icon class
        'tallIcon' => $field->tallIcon,
        'htmlIcon' => $field->htmlIcon,
        'type' => $field->input_type,
        'suffix' => $field->suffix,
        'sfxIcon' => $field->sfxIcon, //Blade icon name
        'sfxIconClass' => $field->sfxIcon, //Blade icon class
        'sfxTallIcon' => $field->sfxTallIcon, //Tall-forms icon name
        'sfxHtmlIcon' => $field->sfxHtmlIcon, //Html example: <i>...</i>
        'autocomplete' => $field->autocomplete,
        'placeholder' => $field->placeholder,
        'step' => $field->step,
        'min' => $field->min,
        'max' => $field->max,
    ]"
    :attr="array_merge([
        $field->wire => $field->key
    ], $field->getAttr('input'))
"/>
