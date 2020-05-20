@php
    $class = $class ?? '';
    $width = $width ?? 'w-full';
    $action = $action ?? 'expression += "'.$content.'"';
@endphp
<div class="p-1 cursor-pointer text-center text-gray-700 {{ $width }}"
     @click="{{ $action }}">
    <div {{ $attributes->merge(['class' => 'border rounded-full '.$class]) }}>
        {{ $content }}
    </div>
</div>
