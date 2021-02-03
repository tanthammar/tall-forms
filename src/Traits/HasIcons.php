<?php


namespace Tanthammar\TallForms\Traits;


trait HasIcons
{
    public $icon;
    public $appendIcon;
    public $tallIcon;
    public $htmlIcon;
    public bool $hasIcon = false;
    public bool $hasAppendIcon = false;
    public bool $tallAppendIcon = false;
    public bool $htmlAppendIcon = false;

    /**
     * Requires Blade UI Icons
     *
     * @param string $blade_ui_icon_path
     * @param bool   $append
     * @return $this
     */
    public function icon(string $blade_ui_icon_path, bool $append = false): self
    {
        if(!$append){
            $this->icon = $blade_ui_icon_path;
            $this->hasIcon = true;
        } else {
            $this->appendIcon = $blade_ui_icon_path;
            $this->hasAppendIcon = true;
        }
        return $this;
    }

    /**
     * Requires you to create a blade file on the defined path
     *
     * @param string $blade_file_path
     * @param bool   $append
     * @return $this
     */
    public function tallIcon(string $blade_file_path, bool $append = false): self
    {
        if(!$append){
            $this->tallIcon = $blade_file_path;
            $this->hasIcon = true;
        } else {
            $this->tallAppendIcon = $blade_file_path;
            $this->hasAppendIcon = true;
        }
        return $this;
    }

    /**
     * Any valid html, example: fontawesome <i></i>
     *
     * @param string $html
     * @param bool   $append
     * @return $this
     */
    public function htmlIcon(string $html, bool $append = false): self
    {
        if(!$append){
            $this->htmlIcon = $html;
            $this->hasIcon = true;
        } else {
            $this->htmlAppendIcon = $html;
            $this->hasAppendIcon = true;
        }
        return $this;
    }

}
