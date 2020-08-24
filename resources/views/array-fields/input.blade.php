<x-tall-input :field="$bind" :colspan="$array_field->colspan ?? 6" :type="$array_field->input_type"
    :prefix="$array_field->prefix ?? null" :icon="$array_field->icon ?? null" :autocomplete="$array_field->autocomplete" :fieldClass="$array_field->class"
    :placeholder="$array_field->placeholder" :help="$array_field->help"
    :label="($array_field->show_label) ? $array_field->label : null" :labelSuffix="$array_field->labelSuffix" :errorMsg="$array_field->errorMsg"
    :step="$array_field->step" :min="$array_field->min" :max="$array_field->max"/>
