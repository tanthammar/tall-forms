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
        $vertical =
            in_array($this->field->type, ['array', 'keyval', 'textarea', 'checkboxes', 'radio'])
            || filled($this->field->afterLabel) || filled($this->field->above) ? '' : ' sm:items-center';
        return $this->field->inline
            ? config('tall-forms.field-attributes.label-field-wrapper-inline') . $vertical
            : config('tall-forms.field-attributes.label-field-wrapper-stacked');
    }

    public function fieldWidth(): string
    {
        return $this->field->inline ? "w-full {$this->fieldW}" : 'w-full';
    }

    public function labelWidth(): string
    {
        $base = 'w-full sm:pr-4 ';
        return $this->field->inline
            ? $base . $this->labelW . ' ' . ($field->inlineLabelAlignment ?? $this->inlineLabelAlignment)
            : $base . config('tall-forms.component-attributes.stacked-label-alignment');
    }

    public function labelSuffixClass(): string
    {
        return config('tall-forms.field-attributes.label-suffix');
    }

    public function render(): View
    {
        return view('tall-forms::components.label-field-wrapper');
    }
}
