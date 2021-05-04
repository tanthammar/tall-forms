<?php


namespace Tanthammar\TallForms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallTallForms extends Command
{
    protected $signature = 'make:tall-forms-installation';
    protected $description = 'Install tall-forms presets';

    protected bool $lv8 = false;
    protected bool $tw2 = false;
    protected bool $jetstream = false;
    protected bool $breeze = false;

    public function handle()
    {
        $this->setEnvironment();

        //Check if current directory is a Git repository
        $inGitRepo = exec('git rev-parse --is-inside-work-tree 2>/dev/null') == "true";
        if ($inGitRepo) {
            $this->gitStart();
            $this->runInstallation();
            $this->gitEnd();
        } else {
            if ($this->confirm('!!!!!! -----HAVE YOU BACKED UP YOUR REPO?------- !!!!!!!')) {
                $this->runInstallation();
            } else {
                $this->info('Installation aborted');
                exit;
            }
        }

    }

    public function runInstallation()
    {
        $this->livewire();
        $this->tailwind();
        $this->theme();
        // $this->icons(); //not needed to publish the icons
        $this->laravelMix();
        $this->wrapper();

//        $this->info('Compiling css');
//        $this->info(exec('npm run dev'));

        $this->info("Installation complete. DON'T FORGET:  ------> npm install && npm run dev");
        $this->info('Please support this package if you find in useful :-)');
    }

    public function gitStart()
    {
        $this->info('git commit "Before Tall Forms Installation"');
        exec('git add .');
        exec('git commit -m "Before Tall Forms Installation"');
    }

    public function gitEnd()
    {
        $this->info('git commit "After Tall Forms Installation"');
        exec('git add .');
        exec('git commit -m "After Tall Forms Installation"');
    }

    public function wrapper()
    {
        $this->info('Installing wrapper view');

        if (!is_dir($directory = resource_path('views/layouts'))) File::makeDirectory($directory, 0755, true);

        $wrapper = File::get(__DIR__ . '/../../resources/stubs/wrapper.blade.php.stub');

        if ($this->jetstream || $this->breeze) {
            $this->fixAppLayout();
            $wrapper = File::get(__DIR__ . '/../../resources/stubs/wrapperJetstream.blade.php.stub');
        } else {
            $this->info('Installing basic app.blade.php layout because you are not using Jetstream or Breeze');
            $applayout = File::get(__DIR__ . '/../../resources/stubs/app.blade.php.stub');
            File::put(resource_path('views/layouts/tall-form-wrapper-layout.blade.php'), $applayout);
        }

        File::put(resource_path('views/layouts/tall-form-wrapper-layout.blade.php'), $wrapper);

        $this->info('Publishing the config file');
        $this->call('vendor:publish', [
            '--tag' => 'tall-form-config'
        ]);

        $this->info('Updating the wrapper view name in config');
        $config = File::get(config_path('tall-forms.php'));
        $config = str_replace('tall-forms::wrapper-layout', 'layouts.tall-form-wrapper-layout', $config);
        File::put(config_path('tall-forms.php'), $config);
    }

    public function fixAppLayout()
    {
        $this->info('Checking app.blade.php ...');
        $app_blade = File::get(resource_path('views/layouts/app.blade.php'));
        $app_blade = str_replace('@livewireStyles', '@livewireStyles' . PHP_EOL. '@stack("styles")', $app_blade);
        $app_blade = str_replace('@livewireScripts', '@livewireScripts' . PHP_EOL. '@stack("scripts")', $app_blade);
        $app_blade = str_replace('{{ $header }}', '{{ $header ?? null }}', $app_blade);
        $app_blade = str_replace('{{ $slot }}', '{{ $slot ?? null }}', $app_blade);
        File::put(resource_path('views/layouts/app.blade.php'), $app_blade);
    }

    public function icons()
    {
        $this->info('Publishing the required icon blade views');
        $this->call('vendor:publish', [
            '--tag' => 'tall-form-icons'
        ]);
    }

    public function theme()
    {
        $custom_css = File::get(__DIR__ . '/../../resources/stubs/custom.css.stub');
        $app_css = File::get(__DIR__ . '/../../resources/stubs/app.css.stub');

        $this->info('Publishing the theme');
        $this->call('vendor:publish', [
            '--tag' => 'tall-form-theme-css'
        ]);

        $this->info('Creating custom.css');
        File::put(resource_path('css/custom.css'), $custom_css);

        $this->info('Creating app.css');
        File::put(resource_path('css/app.css'), $app_css);
    }

    public function tailwind()
    {
        if ($this->breeze || $this->jetstream) {
            $this->tailwindTwo();
            return;
        }

        $tw2 = $this->confirm('Are you on y=Tailwind 2.x or n=Tailwind 1.x');

        if ($tw2) {
            $this->tailwindTwo();
        } else {
            $this->info('ABORTING: This installer only supports Tailwind >= v2');
            exit;
        }

    }

    public function tailwindTwo()
    {
        $this->tw2 = true;
        $this->info('Installing Laravel Mix v6.x');
        $this->info('Installing Tailwind CSS v2.x');
        $this->info('Installing postcss-import');
        $this->info('Adding support for nested css');
        $this->info('Installing postcss-nesting');
        $this->info('Installing autoprefixer');
        $this->info('Installing alpinejs');
        $this->info('Installing @tailwindcss/forms');
        $this->info('Installing @tailwindcss/typography');
        $this->info('Installing @tailwindcss/aspect-ratio');

        $this->info(exec('npm install -D laravel-mix alpinejs tailwindcss@latest postcss-import postcss-nesting autoprefixer@latest @tailwindcss/forms @tailwindcss/typography @tailwindcss/aspect-ratio --save-dev'));
        $config = File::get(__DIR__ . '/../../resources/stubs/tailwindcss/2.0/tailwind.config.js.stub');
        File::put(base_path('tailwind.config.js'), $config);
    }

    private function laravelMix()
    {
        $this->info('Updating webpack.mix.js');

        $mix = File::get(__DIR__ . '/../../resources/stubs/webpackCSS.mix.js.stub');

        File::put(base_path('webpack.mix.js'), $mix);
    }

    private function setEnvironment(): void
    {
        //Laravel 8 or higher
        $this->lv8 = \Illuminate\Foundation\Application::VERSION >= 8;

        if(!$this->lv8) {
            $this->info('ABORTING: This installer only supports Laravel >= v8');
            exit;
        }

        //Jetstream or Breeze
        try {
            $v = \Composer\InstalledVersions::getVersion('laravel/jetstream');
            $this->jetstream = $v == 'dev-master' || $v >= "2.3";
            if(filled($v) && !$this->jetstream) {
                $this->info('ABORTING: This installer only supports Jetstream >= v2.3');
                exit;
            }
        } catch (\Throwable $e) {
            $this->jetstream = false;
        }
        try {
            $v = \Composer\InstalledVersions::getVersion('laravel/breeze');
            $this->breeze = $v == 'dev-master' || $v >= "1.1";
            if(filled($v) && !$this->breeze) {
                $this->info('ABORTING: This installer only supports Breeze >= v1.1');
                exit;
            }
        } catch (\Throwable $e) {
            $this->breeze = false;
        }
    }

    private function livewire()
    {
        try {
            $v = \Composer\InstalledVersions::getVersion('livewire/livewire');
            $livewire = $v == 'dev-master' || $v >= "2";
            if(filled($v) && !$livewire) {
                //LW installed, but old v
                $this->info('Upgrading Livewire');
                exec('composer require livewire/livewire');
            }
        } catch (\Throwable $e) {
            //plain Lv8 and Breeze, no LW installed
            $this->info('Installing Livewire');
            exec('composer require livewire/livewire');
        }
    }
}
