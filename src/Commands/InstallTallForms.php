<?php


namespace Tanthammar\TallForms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallTallForms extends Command
{
    protected $signature = 'make:tall-forms-installation';
    protected $description = 'Install tall-forms presets';

    protected bool $lv8 = false;
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
        $this->javascript();
        // $this->icons(); //not needed to publish the icons
        $this->laravelMix();
        $this->wrapper();
        $this->languages();

//        $this->info('Compiling css');
//        $this->info(exec('npm run dev'));

        $this->info("Installation complete. DON'T FORGET:  ------> npm install && npm run dev");
        $this->info('Please support this package if you find in useful :-)');
    }

    public function gitStart(): void
    {
        $this->info('git commit "Before Tall Forms Installation"');
        exec('git add .');
        exec('git commit -m "Before Tall Forms Installation"');
    }

    public function gitEnd(): void
    {
        $this->info('git commit "After Tall Forms Installation"');
        exec('git add .');
        exec('git commit -m "After Tall Forms Installation"');
    }

    public function wrapper(): void
    {

        if (!is_dir($directory = resource_path('views/layouts'))) File::makeDirectory($directory, 0755, true);

        $applayout = File::get(__DIR__ . '/../../resources/stubs/app.blade.php.stub');
        $wrapper = File::get(__DIR__ . '/../../resources/stubs/wrapper.blade.php.stub');

        if ($this->jetstream) {
            $applayout = File::get(__DIR__ . '/../../resources/stubs/jetstream-app.blade.php.stub');
            $wrapper = File::get(__DIR__ . '/../../resources/stubs/wrapperJetBreeze.blade.php.stub');
        }
        if ($this->breeze) {
            $applayout = File::get(__DIR__ . '/../../resources/stubs/breeze-app.blade.php.stub');
            $wrapper = File::get(__DIR__ . '/../../resources/stubs/wrapperJetBreeze.blade.php.stub');
        }

        $this->info('Installing basic app.blade.php layout');
        File::put(resource_path('views/layouts/app.blade.php'), $applayout);

        $this->info('Installing wrapper view');
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

    public function icons(): void
    {
        $this->info('Publishing the required icon blade views');
        $this->call('vendor:publish', [
            '--tag' => 'tall-form-icons'
        ]);
    }

    public function theme(): void
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

    public function tailwind(): void
    {
        $this->info('Installing Laravel Mix v6.x');
        $this->info('Installing Tailwind CSS v2.x');
        $this->info('Installing postcss-import');
        $this->info('Adding support for nested css');
        $this->info('Installing postcss-nesting');
        $this->info('Installing autoprefixer');
        $this->info('Installing Alpinejs');
        $this->info('Installing Alpine Trap plugin');
        $this->info('Installing Alpine Collapse plugin');
        $this->info('Installing @tailwindcss/forms');
        $this->info('Installing @tailwindcss/typography');
        $this->info('Installing @tailwindcss/aspect-ratio');

        $this->info(exec('npm install -D laravel-mix alpinejs @alpinejs/trap @alpinejs/collapse tailwindcss@2.2.19 postcss-import postcss-nesting autoprefixer@10.2.6 @tailwindcss/forms@0.3.4 @tailwindcss/typography@0.4.1 @tailwindcss/aspect-ratio@0.3.0 --save-dev'));
        $config = File::get(__DIR__ . '/../../resources/stubs/tailwindcss/2.0/tailwind.config.js.stub');
        $this->info('Enabling Tailwind JIT mode, you can disable it in tailwind config');
        File::put(base_path('tailwind.config.js'), $config);
    }

    private function laravelMix(): void
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

    private function livewire(): void
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

    private function javascript(): void
    {
        $app_js = File::get(__DIR__ . '/../../resources/stubs/app.js.stub');
        $alpine_js = File::get(__DIR__ . '/../../resources/stubs/alpine.js.stub');

        $this->info('Updating app.js');
        File::put(resource_path('js/app.js'), $app_js);

        $this->info('Making resources/js/alpine.js');
        File::put(resource_path('js/alpine.js'), $alpine_js);
    }

    private function languages()
    {
        //TODO remove from documentation Quickstart Artisan cmd on next release
        $this->info('Publishing the language files');
        $this->call('vendor:publish', [
            '--tag' => 'tall-form-lang'
        ]);
    }
}
