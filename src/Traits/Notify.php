<?php

namespace Tanthammar\TallForms\Traits;

trait Notify
{
    /*
    You can use this trait in both php or in frontend js
    It either sets a LiveWire property that calls the notify method or
    you can call the notify method directly.
    example use in Alpine js to update the property
    $wire.set('alert', {
        type: 'danger',
        message: Locale == 'sv' //if locale is shared to window
        ? "Bilden du valt överskrider max tillåten dokument storlek. Se 'Max file size' ovanför bilden."
        : "The image you uploaded exceeds max allowed file size, stated above the picture"
    });
    exeample use in js to call the notify function
    $wire.call('notify', 'danger', 'Oh No!');
    */
    public array $alert = [];
    protected bool $withSession = false;

    public function updatedAlert()
    {
        //TODO validate alert values
        $this->notify(
            preset: data_get($this->alert, 'type', 'saved'),
            message: data_get($this->alert, 'message', trans('tf::form.alerts.updated-success')),
            bg: data_get($this->alert, 'bg'),
            icon: data_get($this->alert, 'icon'),
            iconcolor: data_get($this->alert, 'iconcolor')
        );
    }

    protected function withSession(): static
    {
		$this->withSession = true;
		return $this;
	}

    /**
     * Presets: 'info', 'success, 'warning', 'danger', 'happy', 'sad'
     * @param string|null $preset
     * @param string $message
     * @param string $bg
     * @param string $icon
     * @param string $iconcolor
     */
    public function notify(
        null|string $preset = "saved",
        string      $message = "",
        string      $bg = 'tf-notify-bg-default',
        string      $icon = "info",
        string      $iconcolor = "text-white")
    {

        [$bg, $icon, $iconcolor] = match ($preset) {
            'success', 'green', 'saved', 'check' => ['tf-bg-success', 'check', $iconcolor],
            'warning', 'orange',                 => ['tf-bg-warning', 'exclamation', $iconcolor],
            'happy', 'positive'                  => ['bg-white', 'happy', 'text-green-600'],
            'sad', 'negative'                    => ['bg-white', 'sad', 'text-red-600'],
            'danger', 'red'                      => ['tf-bg-danger', 'warning', $iconcolor],
            'info', 'blue'                       => ['tf-bg-info', 'info', $iconcolor],
            default                              => [$bg, $icon, $iconcolor],
        };

        if($preset == 'saved') {
            $message = $message ?: trans('tf::form.alerts.updated-success');
            $this->emitSelf('notify-saved');//x-on:notify-saved.window, flash trans('tf::form.saved') on the form submit button, buttons.root.blade.php
        }

        $payload = [
			'bg'        => $bg,
			'message'   => $message,
            'icon'      => $icon,
            'iconcolor' => $iconcolor,
		];

		if ($this->withSession) {
			session()->flash('notify', $payload);
            //reset withSession
            $this->withSession = false;
			return;
		}

		$this->dispatchBrowserEvent('notify', $payload);
    }
}
