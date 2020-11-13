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
            }
            $this->info('Installation aborted');
        }

    }

    public function runInstallation()
    {
        $this->tailwind();
        $this->theme();
        // $this->icons(); //not needed to publish the icons
        $this->wrapper();

        $this->info('Compiling css');
        $this->info(exec('npm run dev'));

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

        File::put(resource_path('resources/views/components/pages/default.blade.php'), $wrapper);
    }

    public function jetstream()
    {
        $this->info('Checking app.blade.php ...');
        $app_blade = File::get(resource_path('views/layouts/app.blade.php'));
        $app_blade = str_replace('{{ $header }}', '{{ $header ?? null }}', $app_blade);
        $app_blade = str_replace('{{ $slot }}', '{{ $slot ?? null }}', $app_blade);
        File::put(base_path('tailwind.config.js'), $app_blade);
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
        if ($css) {
            $this->info('Adding support for nested css');
            $this->info(exec('npm install postcss-nesting --save-dev'));

            $this->info('Publishing the theme');
            $this->call('vendor:publish', [
                '--tag' => 'tall-form-theme-css'
            ]);
            $this->info('Creating custom.css');
            File::put(resource_path('css/custom.css'), $custom_css);

            $this->info('Creating app.css');
            File::put(resource_path('css/app.css'), $app_css);

            $this->info('Creating webpack.mix.js');
            $mix = File::get(__DIR__ . '/../../resources/stubs/webpack.mix.js.stub');
            File::put(base_path('webpack.mix.js'), $mix);
        } else {
            $this->info('Publishing the theme');
            $this->call('vendor:publish', [
                '--tag' => 'tall-form-theme-sass'
            ]);
            $this->info('Creating custom.scss');
            File::put(resource_path('sass/custom.scss'), $custom_css);

            $this->info('Creating app.scss');
            File::put(resource_path('sass/app.scss'), $app_css);
        }
    }

    public function tailwind()
    {
        //install tailwind
        $this->info('Installing Tailwind CSS');
        $this->info(exec('npm install tailwindcss@latest --save-dev'));

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

        //setup tailwind.config.js
        $tailwind = File::get(__DIR__ . '/../../resources/stubs/tailwind.config.js.stub');
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
        $tailwind = str_replace('REPLACE PLUGINS', $plugins, $tailwind);
        File::put(base_path('tailwind.config.js'), $tailwind);
    }

}
