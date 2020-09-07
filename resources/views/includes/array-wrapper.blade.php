<div class="w-full mt-2">
    @php $repeater = $field @endphp
    @if(isset($form_data[$repeater->name]) && $form_data[$repeater->name])
        <div class="flex flex-col divide-y mb-2 {{ $repeater->array_wrapper_class }}">
            @foreach($form_data[$repeater->name] as $key => $value)
                <div class="py-2">
                    <div class="flex px-2 space-x-3 items-center">
                        <div class="flex-1 sm:grid sm:grid-cols-12 col-gap-2 row-gap-4">
                            @foreach($repeater->fields as $array_field)
                                @php
                                    $temp_key = "{$repeater->key}.{$key}.{$array_field->name}";
                                    $array_field->show_label = false;
                                    $array_field->inline = false;
                                @endphp
                                @include('tall-forms::includes.field-root', ['field' => $array_field])
                            @endforeach
                        </div>
                        <div class="flex-shrink space-x-2 items-center justify-end">
                            @if($repeater->array_sortable)
                                <button class="border rounded border px-1"
                                        wire:click="arrayMoveUp('{{ $repeater->name }}', '{{ $key }}')">
                                    @svg(config('tall-forms.arrow-up-icon'), 'h-4 w-4')
                                </button>

                                <button class="border rounded border px-1"
                                        wire:click="arrayMoveDown('{{ $repeater->name }}', '{{ $key }}')">
                                    @svg(config('tall-forms.arrow-down-icon'), 'h-4 w-4')
                                </button>
                            @endif

                            <button class="{{config('tall-forms.negative')}} rounded shadow px-1 text-white"
                                    wire:click.prevent="arrayRemove('{{ $repeater->name }}', '{{ $key }}')">
                                @svg(config('tall-forms.trash-icon'), 'h-4 w-4')
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <button class="rounded-md shadow-sm text-white {{config('tall-forms.positive')}}" wire:click.prevent="arrayAdd('{{ $repeater->name }}')" style="width:fit-content">
        @svg(config('tall-forms.plus-icon'), 'h-5 w-5 m-2')
    </button>
</div>
