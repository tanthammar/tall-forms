@if($field->input_type === 'hidden')
    <input {{ $field->wire }}="{{ $temp_field_key }}" name="{{ $temp_field_key }}" type="hidden"
    autocomplete="{{ $field->autocomplete }}" class="nosy"
    @foreach($field->getAttr('field') as $key => $value) {{$key}}="{{$value}}" @endforeach/>
@else
    <x-tall-input
        :field="$temp_field_key"
        :id="$temp_field_key"
        :type="$field->input_type"
        :prefix="$field->prefix"
        :icon="$field->icon"
        :fieldClass="$field->class"
        :wrapperClass="$field->wrapperClass"
        :autocomplete="$field->autocomplete"
        :placeholder="$field->placeholder"
        :help="$field->help"
        :errorMsg="$field->errorMsg"
        :step="$field->step"
        :min="$field->min"
        :max="$field->max"/>
@endif
