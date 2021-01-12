<div class="tf-repeater-root">
    @if(filled($field->form_data = data_get($form_data, $field->name)))
        <div class="{{ $field->array_wrapper_class ?? 'tf-repeater-wrapper' }}">
            @foreach($field->form_data as $key => $value)
                <div class="tf-repeater-wrapper-outer" wire:key="{{ md5($field->key.$loop->index) }}">
                    <div class="{{ $field->array_wrapper_grid_class ?? 'tf-repeater-wrapper-grid' }}">
                        @foreach($field->fields as $nested_field)
                            @php
                                $nested_field->key = "{$field->key}.{$key}.{$nested_field->name}";
                                if (!$field->labelEachRow) $nested_field->show_label = $key === 0;
                                $nested_field->inline = $nested_field->inline ?? $field->childInline;
                                $nested_field->colspan = $field->childCols ?? $nested_field->colspan;
                                $nested_field->inArray = true;
                                $nested_field->help = $key === 0 ? $nested_field->help : null;
                                $nested_field->placeholder = $nested_field->placeholder ?? $nested_field->label;
                                $nested_field->wire = filled($field->wire) ? $field->wire : $nested_field->wire;
                            @endphp
                            @include('tall-forms::includes.field-root', ['field' => $nested_field])
                        @endforeach
                    </div>
                    <div class="tf-repeater-btns-wrapper">
                        @if($field->array_sortable)
                            <button type="button" class="tf-repeater-sorter-color" wire:click="arrayMoveUp('{{ $field->name }}', '{{ $key }}')">
                                <x-tall-svg :path="config('tall-forms.arrow-up-icon')" class="tf-repeater-btn-size" />
                            </button>

                            <button type="button" class="tf-repeater-sorter-color" wire:click="arrayMoveDown('{{ $field->name }}', '{{ $key }}')">
                                <x-tall-svg :path="config('tall-forms.arrow-down-icon')" class="tf-repeater-btn-size" />
                            </button>
                        @endif

                        <button type="button" class="tf-repeater-delete-btn" wire:click.prevent="arrayRemove('{{ $field->name }}', '{{ $key }}')">
                            <x-tall-svg :path="config('tall-forms.trash-icon')" class="tf-repeater-btn-size" />
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <button type="button" class="tf-repeater-add-button" wire:click.prevent="arrayAdd('{{ $field->name }}')" style="width:fit-content">
        <x-tall-svg :path="config('tall-forms.plus-icon')" class="tf-repeater-add-button-size" />
    </button>
</div>
{{-- after field --}}
@include('tall-forms::includes.below')
