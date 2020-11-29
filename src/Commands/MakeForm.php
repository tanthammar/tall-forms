<?php

namespace Tanthammar\TallForms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeForm extends Command
{
    protected $signature = 'make:tall-form {name} {--model=Model} {--path=Http/Livewire/Forms} {--modelspath=Models/} {--action=create} {--overwrite=false}';
    protected $description = 'Make a new Laravel Livewire form component.';

    public function handle()
    {
        $stub = $this->option('action') == 'create' ? File::get(__DIR__ . '/../../resources/stubs/create-component.stub') : File::get(__DIR__ . '/../../resources/stubs/update-component.stub');
        $stub = str_replace('FormTitle', config('tall-forms.form-title'), $stub);
        $stub = str_replace('DummyComponent', $this->argument('name'), $stub);
        $stub = str_replace('DummyModel', $this->option('model'), $stub);
        $stub = str_replace('dummymodel', Str::lower($this->option('model')), $stub);

        $modelspath = Str::of($this->option('modelspath'))->replace('/', "\\");
        $stub = str_replace('ModelsPath', $modelspath, $stub);

        //$stub = str_replace('Action', $this->option('action'), $stub);
        //$stub = str_replace('DummyRoute', Str::slug(Str::plural($this->option('model'))), $stub);
        $namespace = Str::of($this->option('path'))->replace('/', "\\");
        $stub = str_replace('Namespace', $namespace, $stub);

        $path = Str::of($this->option('path'))->replace('\\', "/");
        if (!Str::of($path)->endsWith('/')) $path .= "/";
        $file_name = app_path($path . $this->argument('name') . '.php');

        if (!is_dir(app_path($path))) File::makeDirectory(app_path($path), 0755, true);

        if (!File::exists($file_name) || $this->option('overwrite') == 'true' ||  $this->confirm($this->argument('name') . ' already exists. Overwrite it?')) {
            File::put($file_name, $stub);
            $this->info('App/' . $path . $this->argument('name') . ' was made!');
        }
    }
}
