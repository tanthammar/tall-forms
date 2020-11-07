@php
    $repeater = $field;
    $short_parent_name = str_replace('form_data.', '', $parent_name);
    $repeater_form_data = data_get($form_data, $short_parent_name, false);
@endphp
<div class="tf-repeater-root">
    @if(is_array($repeater_form_data) && 0 < count($repeater_form_data))
        <div class="{{ $repeater->array_wrapper_class ?? 'tf-repeater-wrapper' }}">
            @foreach($repeater_form_data as $key => $value)
                <div class="tf-repeater-wrapper-outer" wire:key="{{ md5($repeater->key.$loop->index) }}">
                    <div class="{{ $repeater->array_wrapper_grid_class ?? 'tf-repeater-wrapper-grid' }}">
                        @foreach($repeater->fields as $array_field)
                            @php
                                $temp_key = "{$parent_name}.{$key}.{$array_field->name}";
                                $array_field->show_label = $key === 0;
                                $array_field->inline = $array_field->inline ?? false;
                                $array_field->inArray = true;
                                $array_field->help = $key === 0 ? $array_field->help : null;
                                $array_field->placeholder = $array_field->placeholder ?? $array_field->label;
                            @endphp
                            @include('tall-forms::includes.field-root', ['field' => $array_field])
                        @endforeach
                    </div>
                    <div class="tf-repeater-btns-wrapper">
                        @if($repeater->array_sortable)
                            <button type="button" class="tf-repeater-sorter-color"
                                    wire:click="arrayMoveUp('{{ $short_parent_name }}', '{{ $key }}')">
                                @svg(config('tall-forms.arrow-up-icon'), 'tf-repeater-btn-size')
                            </button>

                            <button type="button" class="tf-repeater-sorter-color"
                                    wire:click="arrayMoveDown('{{ $short_parent_name }}', '{{ $key }}')">
                                @svg(config('tall-forms.arrow-down-icon'), 'tf-repeater-btn-size')
                            </button>
                        @endif

                        <button type="button" class="tf-repeater-delete-btn"
                                wire:click.prevent="arrayRemove('{{ $short_parent_name }}', '{{ $key }}')">
                            @svg(config('tall-forms.trash-icon'), 'tf-repeater-btn-size')
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <button type="button" class="tf-repeater-add-button"
            wire:click.prevent="arrayAdd('{{ $short_parent_name }}')" style="width:fit-content">
        @svg(config('tall-forms.plus-icon'), 'tf-repeater-add-button-size')
    </button>
</div>
{{-- after field --}}
@include('tall-forms::includes.below', ['temp_key' => $repeater->key ])
