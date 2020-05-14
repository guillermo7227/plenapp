@php
    $class = isset($class) ? $class : '';
    $caption = isset($caption) ? $caption : '';
    $captionColor = isset($captionColor) ? $captionColor : '';
@endphp

<div class="px-2 py-3" x-data="{showTitle: false}">
    <p class="mb-2 pl-1 text-sm" x-show="showTitle">{{ $title }}</p>
    <input {{ $attributes->merge(['class' => 'border px-3 py-2 rounded w-full bg-blue-100 '.$class]) }}
           type="text"
           name="{{ $name }}"
           placeholder="{{ $placeholder }}"
           x-ref="input"
           @keyup="showTitle = $refs.input.value.length > 0">
    <p class="pl-1 mt-1 text-xs text-{{$captionColor}}-600">{{ $caption }}</p>
</div>
