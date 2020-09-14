@php $repeater = $field @endphp
<div class="w-full mt-2">
    @if(isset($form_data[$repeater->name]) && $form_data[$repeater->name])
        <div class="{{ $repeater->array_wrapper_class }}">
            @foreach($form_data[$repeater->name] as $key => $value)
                <div class="flex px-2 space-x-3 items-center">
                    <div class="{{ $repeater->array_wrapper_grid_class }}">
                        @foreach($repeater->fields as $array_field)
                            @php
                                $temp_key = "{$repeater->key}.{$key}.{$array_field->name}";
                                $array_field->show_label = $key === 0;
                                $array_field->inline = $array_field->inline ?? false;
                                $array_field->inArray = true;
                                $array_field->help = $key === 0 ? $array_field->help : null;
                                $array_field->placeholder = $array_field->placeholder ?? $array_field->label;
                            @endphp
                            @include('tall-forms::includes.field-root', ['field' => $array_field])
                        @endforeach
                    </div>
                    <div class="flex-shrink space-x-2 items-center justify-end">
                        @if($repeater->array_sortable)
                            <button type="button" class="border rounded border px-1"
                                    wire:click="arrayMoveUp('{{ $repeater->name }}', '{{ $key }}')">
                                @svg(config('tall-forms.arrow-up-icon'), 'h-4 w-4')
                            </button>

                            <button type="button" class="border rounded border px-1"
                                    wire:click="arrayMoveDown('{{ $repeater->name }}', '{{ $key }}')">
                                @svg(config('tall-forms.arrow-down-icon'), 'h-4 w-4')
                            </button>
                        @endif

                        <button type="button" class="{{ config('tall-forms.negative' )}} rounded shadow px-1 text-white"
                                wire:click.prevent="arrayRemove('{{ $repeater->name }}', '{{ $key }}')">
                            @svg(config('tall-forms.trash-icon'), 'h-4 w-4')
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <button type="button" class="rounded-md shadow-sm text-white {{config('tall-forms.positive')}}"
            wire:click.prevent="arrayAdd('{{ $repeater->name }}')" style="width:fit-content">
        @svg(config('tall-forms.plus-icon'), 'h-5 w-5 m-2')
    </button>
</div>
{{-- after field --}}
@include('tall-forms::includes.below', ['temp_key' => $repeater->key ])
