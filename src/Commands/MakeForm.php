<?php

namespace Tanthammar\TallForms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeForm extends Command
{
    protected $signature = 'make:tall-form {name} {--model=Model} {--path=Forms/} {--modelspath=Models\} {--action=create}';
    protected $description = 'Make a new Laravel Livewire form component.';

    public function handle()
    {
        $stub = File::get(__DIR__ . '/../../resources/stubs/component.stub');
        $stub = str_replace('DummyComponent', $this->argument('name'), $stub);
        $stub = str_replace('DummyModel', $this->option('model'), $stub);
        $stub = str_replace('ModelsPath', $this->option('modelspath'), $stub);
        $stub = str_replace('Action', $this->option('action'), $stub);
        $stub = str_replace('FormTitle', config('tall-forms.form-title'), $stub);
        //$stub = str_replace('DummyRoute', Str::slug(Str::plural($this->option('model'))), $stub);
        $stub = str_replace('Namespace', Str::of($this->option('path'))->replace('/', "\\"), $stub);
        $path = app_path('Http/Livewire/'. $this->option('path') . "/" . $this->argument('name') . '.php');

        File::ensureDirectoryExists(app_path('Http/Livewire/') . $this->option('path') . "/");

        if (!File::exists($path) || $this->confirm($this->argument('name') . ' already exists. Overwrite it?')) {
            File::put($path, $stub);
            $this->info('Http/Livewire/' . $this->option('path') . "/" . $this->argument('name')  . ' was made!');
        }
    }
}
