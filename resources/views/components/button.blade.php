@props([
'tag' => 'button',
'size' => 'md',
'type' => 'button',
'icon' => null,
'icons' => [
    'xs' => '-ml-0.5 mr-2 h-3 w-3',
    'sm' => '-ml-0.5 mr-2 h-4 w-4',
    'md' => '-ml-1 mr-2 h-5 w-5',
    'lg' => '-ml-1 mr-3 h-5 w-5',
    'xl' => '-ml-1 mr-3 h-5 w-5'
],
'text' => null,
'sizes' => [
    'xs' => 'px-2 py-1 text-xs rounded',
    'sm' => 'px-3 py-2 text-sm rounded',
    'md' => 'px-4 py-2 text-base rounded',
    'lg' => 'px-4 py-2 text-lg rounded',
    'xl' => 'px-4 py-2 text-xl rounded',
],
'color' => 'indigo',
'colors' => [
    'white' => 'tall-forms-button-white',
    'indigo' => 'tall-forms-button-indigo',
    'blue' => 'tall-forms-button-blue',
    'green' => 'tall-forms-button-green',
    'yellow' => 'tall-forms-button-yellow',
    'red' => 'tall-forms-button-red',
    'gray' => 'tall-forms-button-gray',
    'orange' => 'tall-forms-button-orange',
    'teal' => 'tall-forms-button-teal',
    'info' => 'tall-forms-button-info',
    'positive' => 'tall-forms-button-positive',
    'negative' => 'tall-forms-button-negative',
    'warning' => 'tall-forms-button-warning',
    'primary' => 'tall-forms-button-primary',
]])
<{{$tag}} {{ $attributes->merge([
    'class' => "{$sizes[$size]} {$colors[$color]} inline-flex items-center border border-transparent font-semibold uppercase tracking-wider rounded text-white focus:outline-none",
    'type' => ($tag == 'a') ? 'text/html' : $type
    ]) }}>@if(isset($icon))@svg($icon, $icons[$size])@endif{{ $text ?? null }}{{ $slot }}
</{{$tag}}>
