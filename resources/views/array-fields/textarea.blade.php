<x-tall-textarea
:colspan="$array_field->colspan ?? 6"
:rows="$array_field->textarea_rows"
:field="$temp_key"
:placeholder="$array_field->placeholder"
:help="$array_field->help"
:errorMsg="$array_field->errorMsg"
:label="($array_field->show_label) ? $array_field->label : null"
:fieldClass="$field->class"
:labelSuffix="$array_field->labelSuffix"
/>
