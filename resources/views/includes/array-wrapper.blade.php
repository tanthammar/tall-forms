@php $repeater = $field @endphp
<div class="tall-forms-repeater-root">
    @if(isset($form_data[$repeater->name]) && $form_data[$repeater->name])
        <div class="{{ $repeater->array_wrapper_class ?? 'tall-forms-repeater-wrapper' }}">
            @foreach($form_data[$repeater->name] as $key => $value)
                <div class="tall-forms-repeater-wrapper-outer" wire:key="{{ md5($repeater->key.$loop->index) }}">
                    <div class="{{ $repeater->array_wrapper_grid_class ?? 'tall-forms-repeater-wrapper-grid' }}">
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
                    <div class="tall-forms-repeater-buttons-wrapper">
                        @if($repeater->array_sortable)
                            <button type="button" class="tall-forms-repeater-sorter-color"
                                    wire:click="arrayMoveUp('{{ $repeater->name }}', '{{ $key }}')">
                                @svg(config('tall-forms.arrow-up-icon'), 'tall-forms-repeater-buttons-size')
                            </button>

                            <button type="button" class="tall-forms-repeater-sorter-color"
                                    wire:click="arrayMoveDown('{{ $repeater->name }}', '{{ $key }}')">
                                @svg(config('tall-forms.arrow-down-icon'), 'tall-forms-repeater-buttons-size')
                            </button>
                        @endif

                        <button type="button" class="tall-forms-repeater-delete-color"
                                wire:click.prevent="arrayRemove('{{ $repeater->name }}', '{{ $key }}')">
                            @svg(config('tall-forms.trash-icon'), 'tall-forms-repeater-buttons-size')
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <button type="button" class="tall-forms-repeater-add-button"
            wire:click.prevent="arrayAdd('{{ $repeater->name }}')" style="width:fit-content">
        @svg(config('tall-forms.plus-icon'), 'tall-forms-repeater-add-button-size')
    </button>
</div>
{{-- after field --}}
@include('tall-forms::includes.below', ['temp_key' => $repeater->key ])
