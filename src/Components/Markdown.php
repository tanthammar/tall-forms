<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use \Illuminate\View\Component;
use Tanthammar\TallForms\Traits\Helpers;

class Markdown extends Component
{
    public function __construct(
        public array|object $field = [],
        protected array $options = [],
        public array $attr = [],
    ){
        $this->field = Helpers::mergeFilledToObject($this->defaults(), $field);
        $this->field->key = $this->field->key ?: $this->field->name;
        $this->field->id = $this->field->id ?: $this->field->name;
        $this->field->value = $this->field->deferEntangle ? "\$wire.entangle('".$this->field->key."').defer" : "\$wire.entangle('".$this->field->key."')";
    }


    public function defaults(): array
    {
        return [
            'id' => null, //unique, label for =, falls back to name
            'key' => null, //old(), @entangle, @error, falls back to name
            'name' => 'markdown', //required
            'includeScript' => true, //include external cdn
            'deferEntangle' => true,
            'placeholder' => '',
            'wrapperClass' => 'w-full',
            'value' => '',
        ];
    }

    /**
     * [EasyMDE config](https://github.com/Ionaru/easy-markdown-editor#configuration)
     */
    public function options(): array
    {
        $lang = app()->getLocale() == 'en'; //only English spell checking is supported by EasyMDE
        return array_merge([
            'forceSync' => true,
            'spellChecker' => $lang,
            'placeholder' => $this->field->placeholder,
        ], $this->options);
    }

    public function jsonOptions(): string
    {
        return ', ...'.json_encode((object) $this->options());
    }

    public function render(): View
    {
        return view('tall-forms::components.markdown');
    }
}
