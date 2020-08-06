<x-tall-range :field="$bind" :colspan="$array_field->colspan ?? 6"
              :fieldClass="$array_field->class"
              :help="$array_field->help"
              :label="($array_field->show_label) ? $array_field->label : null" :errorMsg="$array_field->errorMsg"
              :step="$array_field->step" :min="$array_field->min" :max="$array_field->max" />
