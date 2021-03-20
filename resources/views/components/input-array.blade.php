<div x-data="{ inputArray: $wire.entangle('{{$field->key}}'){{$field->defer}} }">
    <template x-for="(item, index) in inputArray" :key="index">
        <input x-model="inputArray[index]"
        @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
        {{ $attributes->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }} />
    </template>
    <button type="button" x-on:click.prevent="inputArray.push('')">Add item</button>
</div>
