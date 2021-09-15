<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;
use Tanthammar\TallForms\Traits\CanBeDisabled;
use Tanthammar\TallForms\Traits\Helpers;

class Trix extends BaseBladeField
{
    use Helpers;


    public function __construct(
        public array|object $field = [],
        public ?string      $value = null,
        public array        $attr = [])
    {
        parent::__construct((array)$field, $attr);
    }


    public function defaults(): array
    {
        return [
            'id' => 'trix',
            'class' => 'form-textarea w-full shadow-inner',
            'defer' => true, //defer entangle
            'includeScript' => true,
            //sponsor field defaults;
            'allowAttachments' => false,
            'attachmentKey' => '',
            'allowedMimeTypes' => [],
            'maxAttachments' => 1,
            'maxKB' => 1024,
            'disabled' => false,
        ];
    }

    public function render(): View
    {
        if ($this->field->allowAttachments) return view('tall-forms-sponsors::components.trix-with-attachments');
        return view('tall-forms::components.trix');
    }
}
