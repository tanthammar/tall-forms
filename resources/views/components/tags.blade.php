<div x-data="{
            newTag: '',
            tags: $wire.entangle('{{ $field->key }}'){{ $field->deferString }},
            addTag() {
                this.newTag = this.newTag.trim()
                if (this.newTag === '') {
                    return
                }
                if (this.tags.includes(this.newTag)) {
                    this.newTag = ''
                    return
                }
                this.tags.push(this.newTag)
                this.newTag = ''
            },
            deleteTag(tagToDelete) {
                this.tags.splice(this.tags.indexOf(tagToDelete), 1)
            },
        }"
>
    <div
        x-show="tags.length || {{ $field->disabled ? 'false' : 'true' }}"
        @class([
            'block w-full transition duration-75 divide-y rounded-md shadow-sm border overflow-hidden',
            'border-gray-300 focus-within:border-primary-600 focus-within:ring-1 focus-within:ring-primary-600' => !$errors->has("$field->key.*"),
            'border-danger-600 ring-danger-600 focus-within:border-danger-600 focus-within:ring-2 focus-within:ring-danger-600' => $errors->has("$field->key.*"),
        ])
    >
        @unless($field->disabled)
            <input
                autocomplete="off"
                placeholder="{{ $field->placeholder }}"
                type="text"
                x-on:keydown.enter.stop.prevent="addTag()"
                x-on:keydown.,.stop.prevent="addTag()"
                x-on:keydown.space.stop.prevent="addTag()"
                x-model="newTag"
                class="block w-full border-0"
            />
        @endunless

        <div
            x-show="tags.length"
            class="bg-white space-x-1 rtl:space-x-reverse relative w-full px-2 py-1"
        >
            <div class="-ml-1 space-x-2 space-y-1">
                <template class="inline" x-for="tag in tags" x-bind:key="tag">
                    <button
                        @unless ($field->disabled)
                        x-on:click="deleteTag(tag)"
                        @endunless
                        type="button"
                        @class([
                            'tf-tags-color inline-flex leading-4 items-center text-sm rounded py-1 px-2 space-x-1',
                            'cursor-default' => $field->disabled,
                        ])
                    >
                        <span x-text="tag"></span>

                        @unless ($field->disabled)
                             <span class="tf-tags-x-color">x</span>
                        @endunless
                    </button>
                </template>
            </div>
        </div>
            @if ($errors->any())
                <div>{{ json_encode($errors->has("$field->key.*")) }}</div>
                @foreach ($errors->keys() as $message)
                    <div>{{ $message }}</div>
                @endforeach
            @endif
    </div>
</div>
