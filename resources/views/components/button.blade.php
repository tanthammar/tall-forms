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
    'xs' => 'px-2.5 py-1.5 text-xs leading-4 rounded',
    'sm' => 'px-3 py-2 text-sm leading-4 rounded-md',
    'md' => 'px-4 py-2 text-sm leading-5 rounded-md',
    'lg' => 'px-4 py-2 text-sm leading-6 rounded-md',
    'xl' => 'px-6 py-3 text-sm leading-6 rounded-md',
],
'color' => 'indigo',
'colors' => [
    'white' => 'border-gray-300 bg-white text-gray-700 hover:text-gray-500 focus:border-blue-300 focus:shadow-outline-blue active:bg-blue-700',
    'indigo' => 'text-indigo-100 bg-indigo-500 hover:bg-indigo-600 focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700',
    'blue' => 'text-blue-100 bg-blue-500 hover:bg-blue-600 focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700',
    'green' => 'text-green-100 bg-green-500 hover:bg-green-600 focus:border-green-700 focus:shadow-outline-green active:bg-green-700',
    'yellow' => 'text-yellow-100 bg-yellow-500 hover:bg-yellow-600 focus:border-yellow-700 focus:shadow-outline-yellow active:bg-yellow-700',
    'red' => 'text-red-100 bg-red-500 hover:bg-red-600 focus:border-red-700 focus:shadow-outline-red active:bg-red-700',
    'gray' => 'text-gray-100 bg-gray-500 hover:bg-gray-600 focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-700',
    'orange' => 'text-orange-100 bg-orange-500 hover:bg-orange-600 focus:border-orange-700 focus:shadow-outline-orange active:bg-orange-700',
    'teal' => 'text-teal-100 bg-teal-500 hover:bg-teal-600 focus:border-teal-700 focus:shadow-outline-teal active:bg-teal-700',
    'info' => config('tall-forms.button-info'),
    'positive' => config('tall-forms.button-positive'),
    'negative' => config('tall-forms.button-negative'),
    'warning' => config('tall-forms.button-warning'),
    'primary' => config('tall-forms.button-primary'),
]])
<{{$tag}} {{ $attributes->merge([
    'class' => "{$sizes[$size]} {$colors[$color]} inline-flex items-center border border-transparent font-semibold tracking-wider rounded text-white focus:outline-none transition ease-in-out duration-150",
    'type' => ($tag == 'a') ? 'text/html' : $type
    ]) }}>@if(isset($icon))@svg($icon, $icons[$size])@endif{{ $text ?? null }}{{ $slot }}
</{{$tag}}>
