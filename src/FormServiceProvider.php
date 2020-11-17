<?php

namespace Tanthammar\TallForms;

use Illuminate\View\Component as IlluminateComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Tanthammar\TallForms\Commands\InstallTallForms;
use Tanthammar\TallForms\Commands\MakeForm;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeForm::class,
                InstallTallForms::class,
            ]);
        }

        $this->publishes([__DIR__ . '/../config/tall-forms.php' => config_path('tall-forms.php')], 'tall-form-config');
        $this->publishes([__DIR__ . '/../resources/views' => resource_path('views/vendor/tall-forms')], 'tall-form-views');
        $this->publishes([__DIR__ . '/../resources/views/icons' => resource_path('views/vendor/tall-forms/views/icons')], 'tall-form-icons');
        $this->publishes([__DIR__ . '/../resources/css/tall-theme.css' => resource_path('css/tall-theme.css')], 'tall-form-theme-css');
        $this->publishes([__DIR__ . '/../resources/css/tall-theme.css' => resource_path('sass/tall-theme.scss')], 'tall-form-theme-sass');

        \Livewire::component('tall-spatie-tags', \Tanthammar\TallForms\LivewireComponents\SpatieTags::class);

        $this->bootViews();
        $this->prefixComponents();
        $this->bladeDirectives();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tall-forms.php', 'tall-forms');
    }

    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-forms');
        Blade::component('tall-forms::components.button', 'tall-button');
        Blade::component('tall-forms::components.spinners.button', 'tall-spinner');
        Blade::component('tall-forms::components.error-icon', 'tall-error-icon');
        Blade::component('tall-forms::components.notification', 'tall-notification');
        Blade::component('tall-forms::components.div-attr', 'tall-attr');
    }

    private function prefixComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            $prefix = 'tall';
            /** @var IlluminateComponent $component */
            foreach (config('tall-forms.components', []) as $alias => $component) {
                $blade->component($component, $alias, $prefix);
            }
        });
    }

    private function bladeDirectives()
    {
        //@tfonce
        Blade::directive('tfonce', function ($expression) {
            [$pushName, $pushSub] = explode(':', trim(substr($expression, 1, -1)));

            $key = '__pushonce_' . str_replace('-', '_', $pushName) . '_' . str_replace('-', '_', $pushSub);

            return "<?php if(! isset(\$__env->{$key})): \$__env->{$key} = 1; \$__env->startPush('{$pushName}'); ?>";
        });

        Blade::directive('endtfonce', function () {
            return '<?php $__env->stopPush(); endif; ?>';
        });
    }
}
