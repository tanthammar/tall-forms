<?php


namespace Tanthammar\TallForms\Traits;


trait HasViews
{
    public $beforeView;
    public $afterView;
    public $afterLabelView;
    public $view;

    public function beforeView(string $blade_view_to_include): self
    {
        $this->beforeView = $blade_view_to_include;
        return $this;
    }
    public function afterView(string $blade_view_to_include): self
    {
        $this->afterView = $blade_view_to_include;
        return $this;
    }

    public function afterLabelView(string $blade_view_to_include): self
    {
        $this->afterLabelView = $blade_view_to_include;
        return $this;
    }
    /**
     * Display a custom view instead of the default field view
     * @param string $your_on_your_own_blade_view
     * @return $this
     */
    public function view(string $your_on_your_own_blade_view): self
    {
        $this->view = $your_on_your_own_blade_view;
        return $this;
    }

}
