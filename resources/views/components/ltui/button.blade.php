@php
    $class = $class ?? '';
    $type = $type ?? 'button';
    $color = $color ?? 'gray';
    $textColor = $textColor ?? 'white';
    $defaultClasses = "rounded-lg border bg-{$color}-800 hover:bg-{$color}-900 text-{$textColor} px-4 py-2 cursor-pointer";
@endphp
<div class="py-3">
    <button {{ $attributes }}
            {{ $attributes->merge(['class' => $defaultClasses.' '.$class]) }}>
            {{ $slot }}
    </button>
</div>
