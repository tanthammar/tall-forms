<form wire:submit.prevent="{{ $onKeyDownEnter }}"
{{ $attributes->whereDoesntStartWith('wire:submit')->merge($attr)->merge(['class' => $class() ]) }}>
{{ $slot }}
</form>
