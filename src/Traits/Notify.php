<?php

namespace Tanthammar\TallForms\Traits;

use Illuminate\Validation\Rule;

trait Notify
{
    /*
    You can use this trait in both php or in frontend js
    exeample use in js to call the notify function
    $wire.call('notify', 'danger', 'Oh No!');
    */

    protected bool $withSession = false;

    //TODO await fix Livewire bug, why this is executed twice, until then remove it
    /**
     * example use in Alpine js to update the property
        $wire.set('alert', {
        preset: 'danger',
        message: Locale == 'sv' //if locale is shared to window
            ? "Bilden du valt överskrider max tillåten dokument storlek. Se 'Max file size' ovanför bilden."
            : "The image you uploaded exceeds max allowed file size, stated above the picture"
        });
    public array $alert = [];
    public function updatedAlert()
    {
        $this->validateOnly('alert', [
            'alert.*' => Rule::in(['preset', 'message', 'bg', 'icon', 'iconcolor']),
            'alert.preset' => ['nullable', Rule::in(['success', 'green', 'saved', 'check', 'warning', 'orange', 'happy', 'positive', 'sad', 'negative', 'danger', 'red', 'info', 'blue'])],
            'alert.message' => 'nullable|alpha_dash|between:2,100',
            'alert.bg' => 'nullable|alpha_dash|between:2,30',
            'alert.icon' => ['nullable', Rule::in(['check', 'exclamation', 'happy', 'sad', 'warning', 'info'])],
            'alert.iconcolor' => 'nullable|alpha_dash|between:2,30',
        ]);

        $this->notify(
            preset: data_get($this->alert, 'preset', 'saved'),
            message: data_get($this->alert, 'message', trans('tf::form.alerts.updated-success')),
            bg: data_get($this->alert, 'bg'),
            icon: data_get($this->alert, 'icon'),
            iconcolor: data_get($this->alert, 'iconcolor')
        );
    }
*/

    protected function withSession(): static
    {
        $this->withSession = true;
        return $this;
    }

    /**
     * Presets: 'info', 'success, 'warning', 'danger', 'happy', 'sad'
     */
    public function notify(
        null|string $preset = "saved",
        null|string $message = "",
        null|string $bg = 'tf-notify-bg-default',
        null|string $icon = "info",
        null|string $iconcolor = "text-white")
    {

        [$bg, $icon, $iconcolor] = match ($preset) {
            'success', 'green', 'saved', 'check' => ['tf-bg-success', 'check', $iconcolor],
            'warning', 'orange',                 => ['tf-bg-warning', 'exclamation', $iconcolor],
            'happy', 'positive'                  => ['bg-white', 'happy', 'text-emerald-600'],
            'sad', 'negative'                    => ['bg-white', 'sad', 'text-red-600'],
            'danger', 'red'                      => ['tf-bg-danger', 'warning', $iconcolor],
            'info', 'blue'                       => ['tf-bg-info', 'info', $iconcolor],
            default => [$bg, $icon, $iconcolor],
        };

        if ($preset == 'saved') {
            $message = $message ?: trans('tf::form.alerts.updated-success');
            $this->emitSelf('notify-saved');//x-on:notify-saved.window, flash trans('tf::form.saved') on the form submit button, buttons.root.blade.php
        }

        $payload = [
            'bg' => $bg,
            'message' => $message,
            'icon' => $icon,
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
