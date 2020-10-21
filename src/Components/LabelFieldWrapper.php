<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class LabelFieldWrapper extends Component
{
    public $field;
    public string $inlineLabelAlignment;
    public string $labelW;
    public string $fieldW;

    public function __construct(
        $field,
        bool $componentInline,
        string $inlineLabelAlignment,
        string $labelW,
        string $fieldW)
    {
        $this->field = $field;
        $is_inline = $field->inline ?? $componentInline;
        $field->inline = $field->inline === false ? false : $is_inline;
        $this->inlineLabelAlignment = $inlineLabelAlignment;
        $this->labelW = $field->labelW ?? $labelW;
        $this->fieldW = $field->fieldW ?? $fieldW;
    }

    public function class(): string
    {
        $vertical = $this->field->align_label_top || filled($this->field->afterLabel) || filled($this->field->above) ? '' : ' sm:items-center';
        return $this->field->inline
            ? 'tall-forms-label-field-wrapper-inline' . $vertical
            : 'tall-forms-label-field-wrapper-stacked';
    }

    public function fieldWidth(): string
    {
        return $this->field->inline ? "w-full {$this->fieldW}" : 'w-full';
    }

    public function labelWidth(): string
    {
        return $this->field->inline
            ? $this->labelW . ' ' . ($field->inlineLabelAlignment ?? $this->inlineLabelAlignment)
            : 'tall-forms-stacked-label-alignment';
    }

    public function render(): View
    {
        return view('tall-forms::components.label-field-wrapper');
    }
}
