<?php
use Tanthammar\TallForms\Tests\Forms\BasicForm;

use function Pest\Livewire\livewire;

it("can initialize a basic form and get some result", function() {

    livewire(BasicForm::class)
        ->set('name', 'Eken testar')
        ->call('save')
        ->assertSee('ok');

});
