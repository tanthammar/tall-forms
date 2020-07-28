<x-tall-select :colspan="$array_field->colspan ?? 6" :field="$bind" 
    :fieldClass="$array_field->class"
    :placeholder="$array_field->placeholder" 
    :help="$array_field->help" 
    :label="$array_field->label"
    :options="$array_field->options" 
    :errorMsg="$array_field->errorMsg" />