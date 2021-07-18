<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\Component;

class BaseBladeComponent extends Component
{

    public function __construct(
        public string $id = "",
        public ?string $wireKey = null,
        public ?string $alpineKey = null,
        public ?string $wModel = null,
        public ?string $xModel = null,

        public ?bool $deferEntangle = null,
        public string $deferString = "",

        public ?string $label = null,
        public ?string $placeholder = null,

        public ?string $wrapperClass = null,
        public ?string $labelClass = null,
        public ?string $class = null,

        public array $attr = [],

        public string $htmlId = "",
        public string $view = ''
    )
    {
//        $this->setDefer();
//        $this->setHtmlId();
//        $this->setXmodel();
    }


//    protected function setDefer()
//    {
//        if (!is_bool($this->deferEntangle)) $this->deferEntangle = $this->defer() ?? false;
//        if ($this->deferEntangle) $this->deferString = '.defer';
//    }

//
//    protected function setHtmlId()
//    {
//
//        if (is_string($this->alpineKey) || is_string($this->wireKey)) {
//            $this->htmlId = $this->alpineKey . '-' . md5($this->wireKey ?? $this->alpineKey);
//        }
//    }

//    protected function setXmodel()
//    {
//        return $this->xModel = $this->xModel === 'x-model' || str_contains($this->xModel, 'x-model.') ? $this->xModel : 'x-model';
//    }

    /**
     * Pass to js {{ json_encode($defer()) }} in Blade = true/false else 1/0
     */
    public function defer(): bool
    {
        return str_contains($this->wModel, 'defer');
    }

    public function lazy(): bool
    {
        return str_contains($this->wModel, 'lazy') || str_contains($this->xModel, 'lazy');
    }

    public function debounce(): bool
    {
        return str_contains($this->wModel, 'debounce') || str_contains($this->xModel, 'debounce');
    }


    public function render()
    {
//        return function (array $data) {

            //set bindings
//            if (is_string($this->wModel) && is_string($this->wireKey)) $data['attributes'][$this->wModel] = $data['attributes'][$this->wModel] ?: $this->wireKey;
//            if (is_string($this->xModel) && is_string($this->alpineKey)) $data['attributes'][$this->xModel] = $data['attributes'][$this->xModel] ?: $this->alpineKey;

            //set Id Attributes
//            if (is_string($this->alpineKey) || is_string($this->wireKey)) {
//                $data['attributes']['name'] = $data['attributes']['name'] ?: $this->htmlId;
//                $data['attributes']['id'] = $data['attributes']['id'] ?: $this->htmlId;
//            }

            //merge custom attributes
//            foreach ($this->attr as $key => $value) {
//                $data['attributes'][$key] = $data['attributes'][$key] ?: $value;
//            }

//            return $this->view;
//        };
    }
}
