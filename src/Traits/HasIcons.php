<?php


namespace Tanthammar\TallForms\Traits;


trait HasIcons
{
    public $icon;
    public $afterIcon;
    public $tallIcon;
    public $htmlIcon;
    public bool $hasIcon = false;
    public bool $hasAfterIcon = false;
    public bool $tallAfterIcon = false;
    public bool $htmlAfterIcon = false;

    /**
     * Requires Blade UI Icons
     *
     * @param string $blade_ui_icon_path
     * @param bool   $isAfter
     * @return $this
     */
    public function icon(string $blade_ui_icon_path, bool $isAfter = false): self
    {
        if(!$isAfter){
            $this->icon = $blade_ui_icon_path;
            $this->hasIcon = true;
        } else {
            $this->afterIcon = $blade_ui_icon_path;
            $this->hasAfterIcon = true;
        }
        return $this;
    }

    /**
     * Requires you to create a blade file on the defined path
     *
     * @param string $blade_file_path
     * @param bool   $isAfter
     * @return $this
     */
    public function tallIcon(string $blade_file_path, bool $isAfter = false): self
    {
        if(!$isAfter){
            $this->tallIcon = $blade_file_path;
            $this->hasIcon = true;
        } else {
            $this->tallAfterIcon = $blade_file_path;
            $this->hasAfterIcon = true;
        }
        return $this;
    }

    /**
     * Any valid html, example: fontawesome <i></i>
     *
     * @param string $html
     * @param bool   $isAfter
     * @return $this
     */
    public function htmlIcon(string $html, bool $isAfter = false): self
    {
        if(!$isAfter){
            $this->htmlIcon = $html;
            $this->hasIcon = true;
        } else {
            $this->htmlAfterIcon = $html;
            $this->hasAfterIcon = true;
        }
        return $this;
    }

}
