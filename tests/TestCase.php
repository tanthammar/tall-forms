<?php

namespace Tanthammar\TallForms\Tests;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Tanthammar\TallForms\FormServiceProvider;
use Livewire\LivewireServiceProvider;

class TestCase extends Orchestra
{
    use InteractsWithViews;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Tanthammar\\TallForms\\Tests\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            FormServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('app.key', 'base64:VosEIUzQIMDUNrsFEWASTNszY59ogkVH2wh4tRxJLxM=');
        config()->set('view.paths', [
            __DIR__ . '/resources/views',
        ]);

        $migration = include __DIR__.'/database/migrations/create_basic_form_models_table.php.stub';
        $migration->up();
    }
}
