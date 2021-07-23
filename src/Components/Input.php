<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Input as Field;
use Tanthammar\TallForms\Traits\Helpers;

class Input extends Component
{
    use Helpers;

    public string $icon_span = 'flex items-center justify-center px-2 border border-gray-300 bg-gray-100 text-gray-600 sm:text-sm leading-normal';
    public string $left_border = 'rounded-l border-r-0';
    public string $right_border = 'rounded-r border-l-0';

    public function __construct(
        public array|object $field = [],
        public array $attr = [],
    )
    {
        $this->field = Helpers::mergeFilledToObject($this->defaults(), $field);
        $this->attr = array_merge($this->options(), $attr);
        $this->field->key = data_get($field, 'key', $this->field->name);
        $this->field->class = $this->class();
        $this->field->hasIcon = !empty($this->field->icon || $this->field->tallIcon || $this->field->htmlIcon);
        $this->field->sfxHasIcon = !empty($this->field->sfxIcon || $this->field->sfxTallIcon || $this->field->sfxHtmlIcon);
    }

    public function defaults(): array
    {
        return [
            'id' => null,
            'name' => null,
            'key' => null, //@error & Livewire prop
            'wrapperClass' => 'tf-input-wrapper',
            'class' => null,
            'errorClass' => "tf-field-error",
            'prefix' => null,
            'hasIcon' => false,
            'icon' => '',
            'tallIcon' => '',
            'htmlIcon' => '',
            'type' => 'text', //any HTML5 input type
            'suffix' => null,
            'sfxHasIcon' => false,
            'sfxIcon' => '', //Blade icon name
            'sfxTallIcon' => '', //Tall-forms icon name
            'sfxHtmlIcon' => '', //Html example: <i>...</i>
            'required' => true,
            'autocomplete' => null,
            'placeholder' => null,
            'step' => 1,
            'min' => 0,
            'max' => null,
        ];
    }

    public function options(): array
    {
        $default = [
            'id' => $this->field->id ?: $this->field->name,
            'name' => $this->field->name,
            'type' => $this->field->type,
            'autocomplete' => $this->field->autocomplete,
            'placeholder' => $this->field->placeholder,
        ];
        if (in_array($this->field->type, ['number', 'range', 'date', 'datetime-local', 'month', 'time', 'week'])) {
            $limits = [
                'min' => $this->field->min,
                'max' => $this->field->max,
                'step' => $this->field->step,
            ];

            $default = array_merge($default, $limits);
        }
        return $default;
    }

    public function class(): string
    {
        $class = $this->field->class ?: "form-input block w-full shadow-inner";
        $class .= $this->field->type == 'color' ? " h-11 p-1 " : null;
//        $class .= ($this->field->prefix || $this->field->hasIcon) ? " rounded-none rounded-r" : " rounded";
        $leftRounded = ($this->field->prefix || $this->field->hasIcon);
        $rightRounded = ($this->field->suffix || $this->field->sfxHasIcon);

        if($leftRounded || $rightRounded){
            $class .= " rounded-none";
            if($leftRounded && !$rightRounded){
                $class .= " rounded-r";
            } else if(!$leftRounded && $rightRounded){
                $class .= " rounded-l";
            }
        } else {
            $class .= " rounded";
        }
        return $class;
    }

    public function error(): string
    {
        return $this->field->class.' '.$this->field->errorClass;
    }

    public function render(): View
    {
        return view('tall-forms::components.input');
    }
}
