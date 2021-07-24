<?php


namespace Tanthammar\TallForms;


use Tanthammar\TallForms\Traits\HasIcons;

class Input extends BaseField
{
    use HasIcons;

    public $input_type = 'text';
    public $autocomplete;
    public $placeholder;
    public $prefix;
    public $step;
    public $min;
    public $max;
    public $required = false;

    public $suffix;
    public $sfxIcon;
    public $sfxIconClass;
    public $sfxTallIcon;
    public $sfxHtmlIcon;
    public bool $sfxHasIcon = false;

    protected function overrides(): self
    {
        $this->type = 'input';
        return $this;
    }

    public function type(string $type): self
    {
        if($type == 'hidden') {
            $this->type = 'hidden';
            return $this;
        }
        if($type == 'range') {
            $this->type = 'range';
            return $this;
        }
        $this->input_type = $type;
        return $this;
    }

    public function autocomplete(string $autocomplete): self
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }

    public function prefix(string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function suffix(string $suffix): self
    {
        $this->suffix = $suffix;
        return $this;
    }

    public function required(): self
    {
        $this->required = true;
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * @param float|string $step
     * @return $this
     */
    public function step($step): self
    {
        $this->step = $step;
        return $this;
    }


    /**
     * @param float|string $min
     * @return $this
     */
    public function min($min): self
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @param float|string $max
     * @return $this
     */
    public function max($max): self
    {
        $this->max = $max;
        return $this;
    }

    public function inputAttr(array $attributes): self
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }

    /**
     * Requires Blade UI Icons
     * @param string $blade_ui_icon_path
     * @return $this
     */
    public function suffixIcon(string $blade_ui_icon_path, ?string $class = null): self
    {
        $this->sfxIcon = $blade_ui_icon_path;
        $this->sfxIconClass = $class;
        $this->sfxHasIcon = true;
        return $this;
    }

    /**
     * Requires you to create a blade file on the defined path
     * @param string $blade_file_path
     * @return $this
     */
    public function suffixTallIcon(string $blade_file_path): self
    {
        $this->sfxTallIcon = $blade_file_path;
        $this->sfxHasIcon = true;
        return $this;
    }

    /**
     * Any valid html, example: fontawesome <i></i>
     * @param string $html
     * @return $this
     */
    public function suffixHtmlIcon(string $html): self
    {
        $this->sfxHtmlIcon = $html;
        $this->sfxHasIcon = true;
        return $this;
    }

}
