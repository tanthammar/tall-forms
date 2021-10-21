<?php


namespace Tanthammar\TallForms\Traits;


trait HasIcons
{
    public $icon;
    public $iconClass;
    public $tallIcon;
    public $htmlIcon;
    public bool $hasIcon = false;

    /**
     * Requires Blade UI Icons
     * @param string $blade_ui_icon_path
     * @return $this
     */
    public function icon(string $blade_ui_icon_path, ?string $class = null): self
    {
        $this->icon = $blade_ui_icon_path;
        $this->iconClass = $class;
        $this->hasIcon = true;
        return $this;
    }

    /**
     * Requires you to create a blade file on the defined path
     * @param string $blade_file_path
     * @return $this
     */
    public function tallIcon(string $blade_file_path): self
    {
        $this->tallIcon = $blade_file_path;
        $this->hasIcon = true;
        return $this;
    }

    /**
     * Any valid html, example: fontawesome <i></i>
     * @param string $html
     * @return $this
     */
    public function htmlIcon(string $html): self
    {
        $this->htmlIcon = $html;
        $this->hasIcon = true;
        return $this;
    }

}
