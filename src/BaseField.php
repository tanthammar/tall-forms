<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Arr;

class BaseField
{
    protected $name;
    protected $type;
    protected $input_type;
    protected $textarea_rows;
    protected $options;
    protected $default;
    protected $autocomplete;
    protected $placeholder;
    protected $help;
    protected $rules;
    protected $view;
    protected $prefix;
    protected $colspan;
    protected $fieldW;
    protected $labelW;
    protected $class;
    protected $group_class = 'rounded border bg-gray-50';
    protected $errorMsg;
    protected $inline = true;

    public function __get($property)
    {
        return $this->$property;
    }

    public function input($type = 'text')
    {
        $this->type = 'input';
        $this->input_type = $type;
        return $this;
    }

    public function textarea($rows = 2)
    {
        $this->type = 'textarea';
        $this->textarea_rows = $rows;
        return $this;
    }

    public function select($options = [])
    {
        $this->type = 'select';
        $this->options($options);
        return $this;
    }

    public function checkbox()
    {
        $this->type = 'checkbox';
        return $this;
    }

    public function checkboxes($options = [])
    {
        $this->type = 'checkboxes';
        $this->options($options);
        return $this;
    }

    public function radio($options = [])
    {
        $this->type = 'radio';
        $this->options($options);
        return $this;
    }

    protected function options($options)
    {
        $this->options = Arr::isAssoc($options) ? array_flip($options) : array_combine($options, $options);
    }

    public function default($default)
    {
        $this->default = $default;
        return $this;
    }

    public function autocomplete($autocomplete)
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function help($help)
    {
        $this->help = $help;
        return $this;
    }

    public function prefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function rules($rules)
    {
        $this->rules = $rules;
        return $this;
    }

    public function view($view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * Default 6 of 6 columns
     */
    public function colspan($width)
    {
        $this->colspan = $width;
        return $this;
    }

    /**
     * Default sm:w-2/3
     */    
    public function fieldWidth($class)
    {
        $this->fieldW = $class;
        return $this;
    }

    /**
     * Used only in inline form
     * Default sm:w-1/3
     */
    public function labelWidth($class)
    {
        $this->labelW = $class;
        return $this;
    }

    /**
     * Applied to the field wrapper
     */
    public function class($classes)
    {
        $this->class = $classes;
        return $this;
    }

    /**
     * Applied to the outer wrapper surrounding Array and KeyVal field groups
     * Default 'rounded border bg-gray-50';
     */
    public function groupClass($classes)
    {
        $this->group_class = $classes;
        return $this;
    }
    
    public function errorMsg($string)
    {
        $this->errorMsg = $string;
        return $this;
    }
}
