<form
@foreach($attr as $key => $value) {{$key}}="{{$value}}" @endforeach
@if($onKeyDownEnter) wire:submit.prevent="{{ $onKeyDownEnter }}" @endif
{{ $attributes->merge(['class' => $class() ]) }}>
{{ $slot }}
</form>
