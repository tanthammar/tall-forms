@if($field->input_type === 'hidden')
    <input {{ $field->wire }}="{{ $field->key }}" name="{{ $field->key }}" type="hidden"
    autocomplete="{{ $field->autocomplete }}" class="nosy"
    @forelse($field->getAttr('field') as $key => $value) {{$key}}="{{$value}}"@endforelse />
@else
    <x-tall-field-wrapper :inline="$field->inline ?? $inline" :field="$field->key" :label="$field->label"
                          :labelSuffix="$field->labelSuffix" :labelW="$field->labelW" :fieldW="$field->fieldW">
        <x-tall-input :field="$field->key" :id="$field->key" :type="$field->input_type" :prefix="$field->prefix"
                      :icon="$field->icon" :fieldClass="$field->class" :autocomplete="$field->autocomplete"
                      :placeholder="$field->placeholder" :help="$field->help" :errorMsg="$field->errorMsg"
                      :step="$field->step" :min="$field->min" :max="$field->max"/>
    </x-tall-field-wrapper>
@endif
