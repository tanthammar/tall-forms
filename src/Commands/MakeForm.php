<?php

namespace Tanthammar\TallForms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeForm extends Command
{
    protected $signature = 'make:tall-form {name} {--model=Model} {--path=Http/Livewire/Forms} {--modelspath=Models/} {--action=create} {--overwrite=false} {--skipexisting=true} {--fields=""}';
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

        //mass create forms from sponsor pkg
        if (filled($fields = $this->option('fields'))) {
            $stub = str_replace("Input::make('Name')->rules('required'),", $fields, $stub);
            $use = "use Tanthammar\TallForms\Input;" . PHP_EOL;
            if(Str::contains($fields, 'Checkbox::make')) $use .= "use Tanthammar\TallForms\Checkbox;" . PHP_EOL;
            if(Str::contains($fields, 'KeyVal::make')) $use .= "use Tanthammar\TallForms\KeyVal;" . PHP_EOL;
            if(Str::contains($fields, 'Repeater::make')) $use .= "use Tanthammar\TallForms\Repeater;" . PHP_EOL;
            if(Str::contains($fields, 'Textarea::make')) $use .= "use Tanthammar\TallForms\Textarea;" . PHP_EOL;
            if(Str::contains($fields, 'DatePicker::make')) $use .= "use Tanthammar\TallFormsSponsors\DatePicker;" . PHP_EOL;
            if(Str::contains($fields, 'Number::make')) $use .= "use Tanthammar\TallFormsSponsors\Number;" . PHP_EOL;
            $stub = str_replace("use Tanthammar\TallForms\Input;", $use, $stub);
        }

        $path = Str::of($this->option('path'))->replace('\\', "/")->finish('/');
        $file_name = app_path($path . $this->argument('name') . '.php');

        if (!is_dir(app_path($path))) File::makeDirectory(app_path($path), 0755, true);

        if (
            !File::exists($file_name)
            || $this->option('overwrite') == 'true'
            || ($this->option('skipexisting') == 'false' && $this->confirm($this->argument('name') . ' for ' . $this->option('model') . ' model, already exists. Overwrite it?'))
        ) {
            File::put($file_name, $stub);
            $this->info('App/' . $path . $this->argument('name') . ' was made!');
        }
    }
}
