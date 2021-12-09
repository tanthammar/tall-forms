<?php
use Livewire\Livewire;

it("can initialize a basic form and get some result", function() {

   Livewire::test(BasicForm::class)
        ->set('name', 'Eken testar')
        ->call('save')
        ->assertSee('ok');

})->skip();
