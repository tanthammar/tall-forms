<?php


namespace Tanthammar\TallForms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallTallForms extends Command
{
    protected $signature = 'make:tall-forms-installation';
    protected $description = 'Install tall-forms presets';

    protected bool $lv8;
    protected bool $css;
    protected bool $tw2;
    protected $jetstream;
    protected bool $jetstreamV1 = false;
    protected bool $jetstreamV2 = false;
    protected $breeze;
    protected bool $breezeV0 = false;
    //protected bool $breezeV1 = false; //not released yet, see setEnvironment()

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
            }
        }

    }

    public function runInstallation()
    {
        $this->tailwind(); //sets $tw2 prop
        $this->theme();
        // $this->icons(); //not needed to publish the icons
        $this->laravelMix();
        $this->wrapper();

//        $this->info('Compiling css');
//        $this->info(exec('npm run dev'));

        $this->info('Installation complete. Please support this package if you find in useful :-)');
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
        $wrapper = File::get(__DIR__ . '/../../resources/stubs/wrapper.blade.php.stub');

        if (filled($this->jetstream) || filled($this->breeze)) {
            $this->fixAppLayout();
            $wrapper = File::get(__DIR__ . '/../../resources/stubs/wrapperJetstream.blade.php.stub');
        }

        if (!is_dir($directory = resource_path('views/layouts'))) File::makeDirectory($directory, 0755, true);
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
        $app_scss = File::get(__DIR__ . '/../../resources/stubs/app.scss.stub');
        if ($this->css) {
            $this->info('Adding support for nested css');
            $this->info(exec('npm install postcss-nesting --save-dev'));

            $this->info('Adding support for postcss import');
            $this->info(exec('npm install postcss-import --save-dev'));

            $this->info('Publishing the theme');
            if($this->tw2) {
                $this->call('vendor:publish', [
                    '--tag' => 'tall-form-theme-css'
                ]);
            } else {
                $this->call('vendor:publish', [
                    '--tag' => 'tall-form-theme-tw1x-css'
                ]);
            }

            $this->info('Creating custom.css');
            File::put(resource_path('css/custom.css'), $custom_css);

            $this->info('Creating app.css');
            File::put(resource_path('css/app.css'), $app_css);
        } else {
            $this->info('Publishing the theme');

            if($this->tw2) {
                $this->call('vendor:publish', [
                    '--tag' => 'tall-form-theme-sass'
                ]);
            } else {
                $this->call('vendor:publish', [
                    '--tag' => 'tall-form-theme-tw1x-sass'
                ]);
            }

            $this->info('Creating custom.scss');
            File::put(resource_path('sass/custom.scss'), $custom_css);

            $this->info('Creating app.scss');
            File::put(resource_path('sass/app.scss'), $app_scss);

        }
    }

    public function tailwind()
    {
        if (filled($this->breeze)) {
            $this->tailwindTwo();
            return;
        }

        if (filled($this->jetstream)) {
            if ($this->jetstreamV1) {
                $this->tailwindOne();
                return;
            }
            if ($this->jetstreamV2) {
                $this->tailwindTwo();
                return;
            }
        }

        $tw2 = $this->confirm('Are you on y=Tailwind 2.x or n=Tailwind 1.x');

        if ($tw2) {
            $this->tailwindTwo();
        } else {
            $this->tailwindOne();
        }

    }

    public function tailwindTwo()
    {
        $this->tw2 = true;
        $this->info('Installing Tailwind CSS v2.x');
        $this->info('Installing postcss-import');
        $this->info('Installing autoprefixer');
        $this->info('Installing alpinejs');
        $this->info('Installing @tailwindcss/forms');
        $this->info('Installing @tailwindcss/typography');
        $this->info('Installing @tailwindcss/aspect-ratio');

        $this->info(exec('tailwindcss@npm:@tailwindcss/postcss7-compat postcss-import autoprefixer alpinejs @tailwindcss/forms @tailwindcss/typography @tailwindcss/aspect-ratio --save-dev'));
        $config = File::get(__DIR__ . '/../../resources/stubs/tailwindcss/2.0/tailwind.config.js.stub');
        File::put(base_path('tailwind.config.js'), $config);
    }

    private function tailwindOne()
    {
        $this->tw2 = false;
        $this->info('Installing Tailwind CSS v1.x');

        $tw19 = $this->confirm('Do you want to use y=Tailwind 1.9.x or n=Tailwind 1.8.x');
        if($tw19) {
            $this->info('Installing Tailwind 1.9.x');
            $this->info(exec('npm install tailwindcss@1.9 --save-dev'));
            $config = File::get(__DIR__ . '/../../resources/stubs/tailwindcss/1.9/tailwind.config.js.stub');
        } else {
            $this->info('Installing Tailwind 1.8.x');
            $this->info(exec('npm install tailwindcss@1.8 --save-dev'));
            $config = File::get(__DIR__ . '/../../resources/stubs/tailwindcss/1.8/tailwind.config.js.stub');
        }


        //install typography plugin
        $this->info('Installing Tailwind Typography plugin');
        $this->info(exec('npm install @tailwindcss/typography --save-dev'));

        //ask, UI or custom forms?
        $ui = $this->confirm('Do you want to use y=Tailwind UI or n=Tailwind Custom Forms plugin?');

        //install Tailwind UI or Custom forms
        if ($ui) {
            $this->info('Installing Tailwind UI');
            $this->info(exec('npm install @tailwindcss/ui --save-dev'));
        } else {
            $this->info('Installing Tailwind Custom Forms plugin');
            $this->info(exec('npm install @tailwindcss/custom-forms --save-dev'));
        }

        //set plugins in tailwind.config.js
        if ($ui) {
            $tailwindW = "require('@tailwindcss/ui')({
                layout: 'sidebar',
            })";
        } else {
            $tailwindW = "require('@tailwindcss/custom-forms')";
        }
        $config = str_replace('TAILWINDV', $tailwindW, $config);
        File::put(base_path('tailwind.config.js'), $config);
    }

    private function laravelMix()
    {
        $this->info('Creating webpack.mix.js');

        //Jetstream v2 & Breeze 0.x use the same webpack.mix.js
        //plain lv8 setup as Breeze
        $mix = File::get(__DIR__ . '/../../resources/stubs/webpackCSS.mix.js.stub');

        if(!$this->lv8) { //sass lv7
            $mix = File::get(__DIR__ . '/../../resources/stubs/webpackSASS.mix.js.stub');
        } elseif ($this->jetstreamV1) { // jetstream v1.x has a require('./webpack.config') statement
            $mix = File::get(__DIR__ . '/../../resources/stubs/webpackJetstreamv1.mix.js.stub');
        }

        File::put(base_path('webpack.mix.js'), $mix);
    }

    private function setEnvironment()
    {
        //Laravel 8 or 7
        $this->lv8 = \Illuminate\Foundation\Application::VERSION >= 8;

        // Css or Sass
        $this->css = $this->lv8 ? true : false;

        //Jetstream or Breeze
        if ($this->lv8) {
            try {
                $this->jetstream = \Composer\InstalledVersions::getVersion('laravel/jetstream');
                //2020-12-07 v1 Jetstream has different webpack.mix.js than v2 Jetstream
                $this->jetstreamV1 = $this->jetstream != 'dev-master' && $this->jetstream <= "1.9.9";
                $this->jetstreamV2 = $this->jetstream == 'dev-master' || $this->jetstream >= "2";
            } catch (\Throwable $e) {
                $this->jetstream = null;
            }
            try {
                $this->breeze = \Composer\InstalledVersions::getVersion('laravel/breeze');
                //v0 Breeze and Jetstream v2 has the same webpack.mix.js
                $this->breezeV0 = $this->breeze == 'dev-master' || $this->breeze <= "1"; //change dev-master to != when v1 is released
                //$this->breezeV1 = $this->breeze == 'dev-master' || $this->breeze <= "1"; //2020-12-07 uncomment when v1 is released, $this->laravelMix() to apply correct webpack mix stub
            } catch (\Throwable $e) {
                $this->breeze = null;
            }
        }
    }
}
