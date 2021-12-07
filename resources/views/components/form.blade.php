<form wire:submit.prevent="{{ $onKeyDownEnter }}" {{ $attributes->whereDoesntStartWith('wire:submit')->merge($attr) }} novalidate>
{{ $slot }}
</form>
