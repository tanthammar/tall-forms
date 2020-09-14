<div @foreach($attr as $key => $value) {{$key}}="{{$value}}" @endforeach>
{{ $slot }}
</div>
