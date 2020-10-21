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
        type: 'negative',
        message: Locale == 'sv' //locale is shared to window
        ? "Bilden du valt överskrider max tillåten dokument storlek. Se 'Max file size' ovanför bilden."
        : "The image you uploaded exceeds max allowed file size, stated above the picture"
    });
    exeample use in js to call the notify function
    @this.call('notify', 'negative', 'Oh No!');
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
                $bg = 'tall-forms-bg-positive';
                $message = trans(config('tall-forms.message-updated-success'));
                $this->emitSelf('notify-saved');
                break;

            case 'positive':
                $bg = 'tall-forms-bg-positive';
                break;

            case 'negative':
                $bg = 'tall-forms-bg-negative';
                break;

            case 'info':
                $bg = 'tall-forms-bg-info';
                break;

            case 'warning':
                $bg = 'tall-forms-bg-warning';
                break;

            default:
                $bg = 'tall-forms-bg-default';
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
