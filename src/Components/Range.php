<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Traits\Helpers;
use Tanthammar\TallForms\Range as Field;

class Range extends Component
{
    public Field $field;
    public string $temp_key;
    public int $colspan;
    public array $attr;
    public string $range_value_class;
    public float $step;
    public float $min;
    public float $max;
    public string $wrapper = 'flex space-x-2 py-2';
    public string $range_labels = 'text-gray-600';

    public function __construct(Field $field, string $tempKey, array $attr = [])
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
        $this->colspan = $field->colspan;
        $this->attr = $attr ?? $field->getAttr('input');
        $this->step = $field->step;
        $this->min = $field->min;
        $this->max = $field->max;
        $this->range_value_class = 'rounded border px-2 font-bold';
        $this->inputAttr();
    }

    public function class(): string
    {
        return config('tall-forms.col-span-classes')[$this->colspan];
    }

    public function inputAttr(): void
    {
        $width = 'flex-1 w-full';
        $custom = ' '.data_get($this->attr, 'class');
        data_set($this->attr, 'class', Helpers::unique_words($width.$custom));
    }

    public function render(): View
    {
        return view('tall-forms::components.range');
    }
}
