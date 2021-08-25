<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;
use Tanthammar\TallForms\Traits\Helpers;

class Input extends BaseBladeField
{
    use Helpers;

    public function __construct(
        public array|object $field = [],
        public array        $attr = [],
    )
    {
        parent::__construct((array)$field, $attr);
        $this->attr = array_merge($this->inputAttributes(), $attr);
        $this->field->hasIcon = !empty($this->field->icon || $this->field->tallIcon || $this->field->htmlIcon);
        $this->field->sfxHasIcon = !empty($this->field->sfxIcon || $this->field->sfxTallIcon || $this->field->sfxHtmlIcon);
        $this->field->class = $this->customClass();
    }

    public function defaults(): array
    {
        return [
            'id' => 'input',
            'name' => null,
            'key' => null, //@error & Livewire prop
            'wrapperClass' => 'tf-input-wrapper',
            'type' => 'text', //any HTML5 input type
            'class' => "form-input block w-full shadow-inner",
            'autoStyling' => true,
            'prefix' => null,
            'hasIcon' => false,
            'icon' => '',
            'iconClass' => null,
            'icon_span' => 'flex items-center justify-center px-2 border border-gray-300 bg-gray-100 text-gray-600 sm:text-sm leading-normal',
            'left_border' => 'rounded-l border-r-0',
            'right_border' => 'rounded-r border-l-0',
            'tallIcon' => '',
            'htmlIcon' => '',
            'suffix' => null,
            'sfxHasIcon' => false,
            'sfxIcon' => '', //Blade icon name
            'sfxIconClass' => '',
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

    public function inputAttributes(): array
    {
        $default = [
            $this->field->wire => $this->field->key,
            'id' => $this->field->id,
            'name' => $this->field->name,
            'type' => $this->field->input_type ?? 'text',
            'autocomplete' => $this->field->autocomplete,
            'placeholder' => $this->field->placeholder,
            'value' => old($this->field->name),
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

    public function customClass(): string
    {
        //override parent class()
        if ($this->field->autoStyling) {
            $class = $this->field->class; //already set in parent class() in construct.
            $class .= $this->field->type == 'color' ? " h-11 p-1 " : null;

            $leftRounded = ($this->field->prefix || $this->field->hasIcon);
            $rightRounded = ($this->field->suffix || $this->field->sfxHasIcon);

            if ($leftRounded || $rightRounded) {
                $class .= " rounded-none";
                if ($leftRounded && !$rightRounded) {
                    $class .= " rounded-r";
                } else if (!$leftRounded && $rightRounded) {
                    $class .= " rounded-l";
                }
            } else {
                $class .= " rounded";
            }
            return $class;
        }
        return $this->field->class;
    }

    //override parent->error() for prefix/suffix border
    protected function error(): string
    {
        return $this->field->appendErrorClass
            ? Helpers::unique_words($this->customClass() . " " . $this->field->appendErrorClass)
            : $this->field->errorClass;
    }

    public function render(): View
    {
        return view('tall-forms::components.input');
    }
}
