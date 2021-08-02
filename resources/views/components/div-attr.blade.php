@props([
    'tag' => 'div',
    'colspan',
    'colclass' => config('tall-forms.col-span-classes'),
    'attr' => [
        'class' => '',
    ]
])
@php
if(isset($colspan) && filled($colspan)) {
    $class = data_get($attr, 'class') .' '. $colclass[$colspan];
    data_set($attr, 'class', $class);
}
@endphp
<{{$tag}} {{ $attributes->merge($attr) }}>
    {{ $slot }}
</{{$tag}}>
