<form
@if($onKeyDownEnter) wire:submit.prevent="{{ $onKeyDownEnter }}" @endif
{{ $attributes->except(['wire:submit', 'wire:submit.prevent'])->merge($attr)->merge(['class' => $class() ]) }}>
{{ $slot }}
</form>
