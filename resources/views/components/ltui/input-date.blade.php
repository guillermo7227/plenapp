@php
    $title = $title ?? '';
    $class = $class ?? '';
    $name = $name ?? '';
    $caption = $caption ?? '';
    $captionColor = $captionColor ?? 'red';
    $defaultClasses = 'border border-gray-400 px-3 py-2 rounded w-full bg-blue-100';
    $cClass = $cClass ?? '';
@endphp
<div class="py-3 w-full {{ $cClass }}" x-data="{showTitle: true}">
    <p class="mb-2 pl-1 text-sm" x-show="showTitle">{{ $title }}</p>

    <input {{ $attributes->merge(['class' => $defaultClasses.' '.$class ]) }}
           {{ $attributes }}
           type="date"
           x-ref="input" />

   <p class="pl-1 mt-1 text-xs text-{{ $captionColor }}-600">{{ $caption }}</p>
</div>
