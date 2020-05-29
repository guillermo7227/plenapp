@php
    $method = $method ?? 'POST';
    $attrMethod = strtoupper($method) == 'GET' ? 'GET' : 'POST';
    unset($attributes['method']);
@endphp
<form {{ $attributes }} method="{{ $attrMethod }}">
    @if ($attrMethod != 'GET')
      @csrf
      @method($method)
    @endif
    {{ $slot }}
</form>
