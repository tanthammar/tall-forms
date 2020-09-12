<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class LabelFieldWrapper extends Component
{
    public $field;
    public string $inlineLabelAlignment;

    public function __construct($field, bool $componentInline, string $inlineLabelAlignment)
    {
        $this->field = $field;
        $is_inline = $field->inline ?? $componentInline;
        $field->inline = $field->inline === false ? false : $is_inline;
        $this->inlineLabelAlignment = $inlineLabelAlignment;
    }

    public function class(): string
    {
        return $this->field->inline
            ? config('tall-forms.field-attributes.label-field-wrapper-inline')
            : config('tall-forms.field-attributes.label-field-wrapper-stacked');
    }

    public function fieldWidth(): string
    {
        return $this->field->inline ? "w-full {$this->field->fieldW}" : 'w-full';
    }

    public function labelWidth(): string
    {
        $base = 'w-full sm:pr-4 ';
        return $this->field->inline
            ? $base . $this->field->labelW . ' ' . ($field->inlineLabelAlignment ?? $this->inlineLabelAlignment)
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
