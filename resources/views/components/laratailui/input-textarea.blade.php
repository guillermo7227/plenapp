@php
    $class = isset($class) ? $class : '';
    $caption = isset($caption) ? $caption : '';
    $captionColor = isset($captionColor) ? $captionColor : '';
@endphp

<div class="px-2 py-3" x-data="{showTitle: false}">
    <p class="mb-2 pl-1 text-sm" x-show="showTitle">{{ $title }}</p>
    <textarea {{ $attributes->merge(['class' => 'border px-3 py-2 rounded w-full bg-blue-100 '.$class]) }}
           name="{{ $name }}"
           rows="5"
           placeholder="{{ $placeholder }}"
           x-ref="input"
           @keyup="showTitle = $refs.input.value.length > 0"></textarea>
    <p class="pl-1 mt-1 text-xs text-{{$captionColor}}-600">{{ $caption }}</p>
</div>
