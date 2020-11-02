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
        message: Locale == 'sv' //locale is shared to window
        ? "Bilden du valt överskrider max tillåten dokument storlek. Se 'Max file size' ovanför bilden."
        : "The image you uploaded exceeds max allowed file size, stated above the picture"
    });
    exeample use in js to call the notify function
    @this.call('notify', 'danger', 'Oh No!');
    */
    public array $alert = [];

    public function updatedAlert()
    {
        $this->notify(
            array_get($this->alert, 'type', 'saved'),
            array_get($this->alert, 'message', trans(config('tall-forms.message-updated-success')))
        );
    }

    public function notify($type = "saved", $message = "")
    {
        $bg = null;
        switch ($type) {
            case 'saved':
                $bg = 'tf-bg-success';
                $message = trans(config('tall-forms.message-updated-success'));
                $this->emitSelf('notify-saved');
                break;

            case 'success':
                $bg = 'tf-bg-success';
                break;

            case 'danger':
                $bg = 'tf-bg-danger';
                break;

            case 'info':
                $bg = 'tf-bg-info';
                break;

            case 'warning':
                $bg = 'tf-bg-warning';
                break;

            default:
                $bg = 'tf-notify-bg-default';
                break;
        }
        $this->dispatchBrowserEvent(
            'notify',
            [
                'bg' => $bg,
                'message' =>  $message,
            ]
        );
    }
}
