<div>
   @if (isset($data))
<ul>
    @foreach ($data as $key => $value)
        <li>{{ $key }}: {{ $value }}</li>
    @endforeach
</ul>
   @endif
</div>
