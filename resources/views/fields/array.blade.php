<x-tall-field-wrapper :inline="$field->inline" :field="$field->name" :label="$field->label" :labelW="$field->labelW" :fieldW="$field->fieldW">
    @include('tall-forms::fields.error-help')
    <div class="w-full mt-2">
        @if(isset($form_data[$field->name]) && $form_data[$field->name])
            <div class="flex flex-col divide-y mb-2 {{ $field->group_class }}">
                @foreach($form_data[$field->name] as $key => $value)
                    <div class="py-2">
                        <div class="flex px-2 space-x-3 items-center">
                            <div class="flex-1 sm:grid sm:grid-cols-12 col-gap-2 row-gap-4">
                                @foreach($field->array_fields as $array_field)
                                    @php $bind = "{$field->key}.{$key}.{$array_field->name}" @endphp
                                    @include('tall-forms::array-fields.' . $array_field->type)
                                @endforeach
                            </div>
                            <div class="flex-shrink space-x-2 items-center justify-end">
                                @if($field->array_sortable)
                                    <button class="border rounded border px-1"
                                            wire:click="arrayMoveUp('{{ $field->name }}', '{{ $key }}')">
                                        @svg(config('tall-forms.arrow-up-icon'), 'h-4 w-4')
                                    </button>

                                    <button class="border rounded border px-1"
                                            wire:click="arrayMoveDown('{{ $field->name }}', '{{ $key }}')">
                                        @svg(config('tall-forms.arrow-down-icon'), 'h-4 w-4')
                                    </button>
                                @endif

                                <button class="{{config('tall-forms.negative')}} rounded shadow px-1 text-white"
                                        onclick="confirm('{{ __('Are you sure?') }}') || event.stopImmediatePropagation();"
                                        wire:click="arrayRemove('{{ $field->name }}', '{{ $key }}')">
                                    @svg(config('tall-forms.trash-icon'), 'h-4 w-4')
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <button class="rounded-md shadow-sm text-white {{config('tall-forms.positive')}}" wire:click="arrayAdd('{{ $field->name }}')" style="width:fit-content">
            @svg(config('tall-forms.plus-icon'), 'h-5 w-5 m-2')
        </button>
    </div>
</x-tall-field-wrapper>
