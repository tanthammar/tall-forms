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
    'xs' => 'px-2 py-1 text-xs rounded leading-normal',
    'sm' => 'px-3 py-2 text-sm rounded leading-normal',
    'md' => 'px-4 py-2 text-base rounded leading-normal',
    'lg' => 'px-4 py-2 text-lg rounded leading-normal',
    'xl' => 'px-4 py-2 text-xl rounded leading-normal',
],
'color' => 'indigo',
'colors' => [
    'white' => 'tf-btn-white',
    'indigo' => 'tf-btn-indigo',
    'blue' => 'tf-btn-blue',
    'green' => 'tf-btn-green',
    'yellow' => 'tf-btn-yellow',
    'red' => 'tf-btn-red',
    'gray' => 'tf-btn-gray',
    'orange' => 'tf-btn-orange',
    'teal' => 'tf-btn-teal',
    'info' => 'tf-btn-info',
    'success' => 'tf-btn-success',
    'danger' => 'tf-btn-danger',
    'warning' => 'tf-btn-warning',
    'primary' => 'tf-btn-primary',
    'secondary' => 'tf-btn-secondary',
]])
<{{$tag}} {{ $attributes->merge([
    'class' => "{$sizes[$size]} {$colors[$color]} tf-btn",
    'type' => ($tag == 'a') ? 'text/html' : $type
    ]) }}>@if(isset($icon))<x-tall-svg :path="$icon" :class="$icons[$size]" />@endif{{ $text ?? null }}{{ $slot }}
</{{$tag}}>
