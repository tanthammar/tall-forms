<div 
	x-data= "{ choice: @entangle($field->key).defer }"
	x-init="() => {
	var choices = new Choices($refs.{{ $field->name }}, {
		itemSelectText: '',
	});
	choices.passedElement.element.addEventListener(
	  'change',
	  function(event) {
			values = event.detail.value;
		    @this.set(`{{ $field->key}}`, values);
	  },
	  false,
	);
	let selected = parseInt(@this.get{!! md5($field->key) !!}).toString();
	choices.setChoiceByValue(selected);
	}"
    wire:ignore
	>
    <select @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach id="{{ $field->name }}" wire-model="{{ $field->key }}" x-ref="{{ $field->name }}">
    	<option value="">{{ isset($field->placeholder) ? $field->placeholder : "trans(config('tall-forms.select-placeholder')" }}</option> 
    	@if(count($field->options)>0)
	    	@foreach($field->options as $key=>$value)
	    		<option wire:key="{{ md5($field->key.$value) }}" value="{{$key}}" >{{$value}}</option>
	    	@endforeach
    	@endif
    </select>
</div>
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
@endpush

