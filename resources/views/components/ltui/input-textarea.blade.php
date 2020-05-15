@php
    $title = $title ?? '';
    $class = $class ?? '';
    $name = $name ?? '';
    $caption = $caption ?? '';
    $captionColor = $captionColor ?? 'red';
    $defaultClasses = 'border border-gray-400 px-3 py-2 rounded w-full bg-blue-100';
@endphp
<div class="py-3" x-data="{showTitle: false}">
    <p class="mb-2 pl-1 text-sm" x-show="showTitle">{{ $title }}</p>
    <textarea {{ $attributes->merge(['class' => $defaultClasses.' '.$class]) }}
              rows="5"
              {{ $attributes }}
              x-ref="input"
              @keyup="showTitle = $refs.input.value.length > 0"
    ></textarea>
    <p class="pl-1 mt-1 text-xs text-{{ $captionColor }}-600">{{ $caption }}</p>
</div>
