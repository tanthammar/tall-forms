<?php


namespace Tanthammar\TallForms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallTallForms extends Command
{
    protected $signature = 'make:tall-forms-installation';
    protected $description = 'Install tall-forms presets';

    public function handle()
    {
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
        $this->tailwind();
        $this->theme();
        // $this->icons(); //not needed to publish the icons
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

        $v8 = $this->confirm('Do you use y=Laravel 8 or n=Laravel 7 ?');
        if ($v8 && $this->confirm('Do you use Jetstream y/n ?')) {
            $this->jetstream();
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

    public function jetstream()
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
        $css = $this->confirm('Do you use y=CSS or n=SASS ?');
        $custom_css = File::get(__DIR__ . '/../../resources/stubs/custom.css.stub');
        $app_css = File::get(__DIR__ . '/../../resources/stubs/app.css.stub');
        $app_scss = File::get(__DIR__ . '/../../resources/stubs/app.scss.stub');
        if ($css) {
            $this->info('Adding support for nested css');
            $this->info(exec('npm install postcss-nesting --save-dev'));

            $this->info('Adding support for postcss import');
            $this->info(exec('npm install postcss-import --save-dev'));

            $this->info('Publishing the theme');
            $this->call('vendor:publish', [
                '--tag' => 'tall-form-theme-css'
            ]);
            $this->info('Creating custom.css');
            File::put(resource_path('css/custom.css'), $custom_css);

            $this->info('Creating app.css');
            File::put(resource_path('css/app.css'), $app_css);

            $this->info('Creating webpack.mix.js');
            $mix = File::get(__DIR__ . '/../../resources/stubs/webpackCSS.mix.js.stub');
            File::put(base_path('webpack.mix.js'), $mix);
        } else {
            $this->info('Publishing the theme');
            $this->call('vendor:publish', [
                '--tag' => 'tall-form-theme-sass'
            ]);
            $this->info('Creating custom.scss');
            File::put(resource_path('sass/custom.scss'), $custom_css);

            $this->info('Creating app.scss');
            File::put(resource_path('sass/app.scss'), $app_scss);

            $this->info('Creating webpack.mix.js');
            $mix = File::get(__DIR__ . '/../../resources/stubs/webpackSASS.mix.js.stub');
            File::put(base_path('webpack.mix.js'), $mix);
        }
    }

    public function tailwind()
    {
        //install tailwind
        $this->info('Installing Tailwind CSS');

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
            $plugins = "
    plugins: [
        require('@tailwindcss/ui')({
            layout: 'sidebar',
        }),
        require('@tailwindcss/typography'),
    ],";
        } else {
            $plugins = "
    plugins: [
        require('@tailwindcss/custom-forms'),
        require('@tailwindcss/typography'),
    ],";
        }
        $config = str_replace('REPLACE PLUGINS', $plugins, $config);
        File::put(base_path('tailwind.config.js'), $config);
    }

}
