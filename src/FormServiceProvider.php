<?php

namespace Tanthammar\TallForms;

use BladeUIKit\Components\BladeComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Tanthammar\TallForms\Commands\MakeForm;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([MakeForm::class]);
        }
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->publishes([__DIR__ . '/../config/tall-forms.php' => config_path('tall-forms.php')], 'form-config');
        $this->publishes([__DIR__ . '/../resources/views' => resource_path('views/vendor/tall-forms')], 'form-views');

        \Livewire::component('tall-tags-update', \Tanthammar\TallForms\Tags\TagsFieldUpdate::class);
        \Livewire::component('tall-tags-create', \Tanthammar\TallForms\Tags\TagsFieldCreate::class);

        $this->bootViews();
        $this->prefixBladeUIComponents();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tall-forms.php', 'tall-forms');
    }

    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-forms');
        Blade::component('tall-forms::components.button', 'button');
        Blade::component('tall-forms::components.spinners.button', 'tall-spinner');
        Blade::component('tall-forms::components.input', 'tall-input');
        Blade::component('tall-forms::components.range', 'tall-range');
        Blade::component('tall-forms::components.checkbox', 'tall-checkbox');
        Blade::component('tall-forms::components.radio', 'tall-radio');
        Blade::component('tall-forms::components.select', 'tall-select');
        Blade::component('tall-forms::components.textarea', 'tall-textarea');
        Blade::component('tall-forms::components.label', 'tall-label');
        Blade::component('tall-forms::components.error-icon', 'tall-error-icon');
        Blade::component('tall-forms::components.field-wrapper', 'tall-field-wrapper');
        Blade::component('tall-forms::components.notification', 'tall-notification');
        Blade::component('tall-forms::components.div-attr', 'tall-attr');
    }

    private function prefixBladeUIComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            $prefix = 'tall-buk';
            /** @var BladeComponent $component */
            foreach ($this->extendedComponents() as $alias => $component) {
                $blade->component($component, $alias, $prefix);
            }
        });
    }

    private function extendedComponents(): array
    {
        return [
            'alert' => Components\Alerts\Alert::class,
            'form-button' => Components\Buttons\FormButton::class,
            'logout' => Components\Buttons\Logout::class,
            'carbon' => Components\DateTime\Carbon::class,
            'countdown' => Components\DateTime\Countdown::class,
            'easy-mde' => Components\Editors\EasyMDE::class,
            'trix' => Components\Editors\Trix::class,
            'error' => Components\Forms\Error::class,
            'form' => Components\Forms\Form::class,
            'label' => Components\Forms\Label::class,
            'input' => Components\Input::class,
            'checkbox' => Components\Forms\Inputs\Checkbox::class,
            'color-picker' => Components\Forms\Inputs\ColorPicker::class,
            'email' => Components\Forms\Inputs\Email::class,
            'password' => Components\Forms\Inputs\Password::class,
            'pikaday' => Components\Forms\Inputs\Pikaday::class,
            'textarea' => Components\Forms\Inputs\Textarea::class,
            'html' => Components\Layouts\Html::class,
            'social-meta' => Components\Layouts\SocialMeta::class,
            'mapbox' => Components\Maps\Mapbox::class,
            'markdown' => Components\Markdown\Markdown::class,
            'toc' => Components\Markdown\ToC::class,
            'dropdown' => Components\Navigation\Dropdown::class,
            'avatar' => Components\Support\Avatar::class,
            'cron' => Components\Support\Cron::class,
            'unsplash' => Components\Support\Unsplash::class,
        ];
    }
}
