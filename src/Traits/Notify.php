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
            array_get($this->alert, 'type', 'saved'),
            array_get($this->alert, 'message', trans('tf::form.alerts.updated-success'))
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
        string $message = "",
        string $bg = 'tf-notify-bg-default',
        string $icon="info",
        string $iconcolor="text-white" )
    {
        switch ($type) {
            case 'saved':
                $bg = 'tf-bg-success';
                $message = trans('tf::form.alerts.updated-success');
                $icon = 'check';
                $this->emitSelf('notify-saved');
                break;

            case 'positive':
            case 'green':
            case 'success':
            case 'check':
                $bg = 'tf-bg-success';
                $icon = 'check';
                break;

            case 'negative':
            case 'red':
            case 'danger':
                $bg = 'tf-bg-danger';
                $icon = 'warning';
                break;

            case 'info':
            case 'blue':
                $bg = 'tf-bg-info';
                $icon = 'info';
                break;

            case 'warning':
            case 'orange':
            case 'exclamation':
                $bg = 'tf-bg-warning';
                $icon = 'exclamation';
                break;

            case 'happy':
                $bg = 'bg-white';
                $icon = 'happy';
                $iconcolor = 'text-green-400';
                break;

            case 'sad':
                $bg = 'bg-white';
                $icon = 'sad';
                $iconcolor = 'text-red-400';
                break;
        }

        $payload = [
			'bg'      => $bg,
			'message' => $message,
            'icon' => $icon,
            'iconcolor' => $iconcolor,
		];

		if ($this->_withSession) {
			session()->flash('notify', $payload);

			return;
		}

		$this->dispatchBrowserEvent('notify', $payload);
    }
}
