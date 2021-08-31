<?php

namespace Tanthammar\TallForms\Traits;

trait Notify
{
    /*
    You can use this trait in both php or in frontend js
    It either sets a LiveWire property that calls the notify method or
    you can call the notify method directly.
    example use in js to update the property
    @this.set('alert', {
        type: 'danger',
        message: Locale == 'sv' //if locale is shared to window
        ? "Bilden du valt överskrider max tillåten dokument storlek. Se 'Max file size' ovanför bilden."
        : "The image you uploaded exceeds max allowed file size, stated above the picture"
    });
    exeample use in js to call the notify function
    @this.call('notify', 'danger', 'Oh No!');
    */
    public array $alert = [];
    private bool $_withSession = false;

    public function updatedAlert()
    {
        $this->notify(
            type: data_get($this->alert, 'type', 'saved'),
            message: data_get($this->alert, 'message', trans('tf::form.alerts.updated-success')),
            bg: data_get($this->alert, 'bg'),
            icon: data_get($this->alert, 'icon'),
            iconcolor: data_get($this->alert, 'iconcolor')
        );
    }

    public function withSession()
	{
		$this->_withSession = true;
		return $this;
	}

    /**
     * Available icons: 'info', 'check, 'exclamation', 'warning', 'happy', 'sad'
     * @param string|null $type
     * @param string $message
     * @param string $bg
     * @param string $icon
     * @param string $iconcolor
     */
    public function notify(
        null|string $type = "saved",
        string      $message = "",
        string      $bg = 'tf-notify-bg-default',
        string      $icon = "info",
        string      $iconcolor = "text-white")
    {

        [$bg, $icon, $iconcolor] = match ($type) {
            'saved', 'positive', 'green', 'success', 'check' => ['tf-bg-success', 'check', $iconcolor],
            'warning', 'orange', 'exclamation'               => ['tf-bg-warning', 'exclamation', $iconcolor],
            'negative', 'red', 'danger'                      => ['tf-bg-danger', 'warning', $iconcolor],
            'info', 'blue'                                   => ['tf-bg-info', 'info', $iconcolor],
            'happy'                                          => ['bg-white', 'happy', 'text-green-600'],
            'sad'                                            => ['bg-white', 'sad', 'text-red-600'],
            default                                          => [$bg, $icon, $iconcolor],
        };

        if($type == 'saved') {
            $message = $message ?: trans('tf::form.alerts.updated-success');
            $this->emitSelf('notify-saved');//x-on:notify-saved.window, flash trans('tf::form.saved') on the form submit button, buttons.root.blade.php
        }

        $payload = [
			'bg'        => $bg,
			'message'   => $message,
            'icon'      => $icon,
            'iconcolor' => $iconcolor,
		];

		if ($this->_withSession) {
			session()->flash('notify', $payload);
			return;
		}

		$this->dispatchBrowserEvent('notify', $payload);
    }
}
