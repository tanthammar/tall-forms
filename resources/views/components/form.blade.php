<form wire:submit.prevent="{{ $onKeyDownEnter }}" {{ $attributes->whereDoesntStartWith('wire:submit')->merge($attr) }}>
{{ $slot }}
</form>
