<form
@foreach($attr as $key => $value) {{$key}}="{{$value}}" @endforeach
@if($onKeyDownEnter) wire:keydown.enter.prevent="{{ $onKeyDownEnter }}" @endif
{{ $attributes->merge(['class' => $class() ]) }}>
{{ $slot }}
</form>
