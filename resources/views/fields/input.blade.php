@php $alpineKey = $field->alpineKey ?? 'input'; @endphp
<x-tall-input :field="[
        'name' => $field->getHtmlId($_instance->id), //id falls back to name
        'key' => $field->key, //@error & Livewire prop
        'wrapperClass' => $field->wrapperClass,
        'class' => $field->class,
        'prefix' => $field->prefix,
        'icon' => $field->icon,
        'tallIcon' => $field->tallIcon,
        'htmlIcon' => $field->htmlIcon,
        'type' => $field->input_type,
        'suffix' => $field->suffix,
        'sfxIcon' => $field->sfxIcon, //Blade icon name
        'sfxTallIcon' => $field->sfxTallIcon, //Tall-forms icon name
        'sfxHtmlIcon' => $field->sfxHtmlIcon, //Html example: <i>...</i>
        'autocomplete' => $field->autocomplete,
        'placeholder' => $field->placeholder,
        'step' => $field->step,
        'min' => $field->min,
        'max' => $field->max,
    ]"
    x-data="{ {{ $alpineKey }}: $wire.entangle('{{ $field->key }}'){{ $field->deferString }} }"
    :attr="array_merge([
        $field->xmodel => $alpineKey
    ], $field->getAttr('input'))
"/>
