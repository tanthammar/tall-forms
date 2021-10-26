<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class LabelFieldWrapper extends Component
{
    public string $wrapperClass = '';
    public string $fieldWidth = '';
    public string $labelWidth = '';

    public function __construct(
        public object $field,
        public bool $inline = true,
        public string $labelW = 'tf-label-width',
        public string $fieldW = 'tf-field-width',
        public string $inlineLabelAlignment = 'tf-inline-label-alignment',
        public string $stackedLabelAlignment = 'tf-stacked-label-alignment',
    )
    {
        $is_inline = $field->inline ?? $inline;
        $field->inline = $field->inline === false ? false : $is_inline;
        $this->labelW = $field->labelW ?: $labelW;
        $this->fieldW = $field->fieldW ?: $fieldW;
        //set these in construct, else executed multiple times
        $this->wrapperClass = $this->wrapperClass();
        $this->fieldWidth = $this->fieldWidth();
        $this->labelWidth = $this->labelWidth();
    }

    public function wrapperClass(): string
    {
        $vertical = $this->field->align_label_top || filled($this->field->afterLabel) || filled($this->field->above) ? '' : ' sm:items-center';
        return $this->field->inline
            ? 'tf-label-field-wrapper-inline' . $vertical
            : 'tf-label-field-wrapper-stacked';
    }

    public function fieldWidth(): string
    {
        return $this->field->inline ? $this->fieldW : 'w-full';
    }

    /**
     * Appended to ->labelWrapperClass()
     * @return string
     */
    public function labelWidth(): string
    {
        return $this->field->inline
            ? $this->labelW . ' ' . ($this->field->inlineLabelAlignment ?: $this->inlineLabelAlignment)
            : $this->stackedLabelAlignment;
    }

    public function render(): View
    {
        return view('tall-forms::components.label-field-wrapper');
    }
}
