@php
    $class = $class ?? '';
    $type = $type ?? 'button';
    $color = $color ?? 'white';
    $bgColor = $bgColor ?? 'gray-800';
    preg_match_all('![a-zA-Z]+!', $bgColor, $colorName); // get color name
    preg_match_all('!\d+!', $bgColor, $colorNumber); // get color number
    $hoverBgColor = $hoverBgColor ?? count($colorNumber[0]) > 0 ? $colorName[0][0].'-'.((int)($colorNumber[0][0])+100) : $bgColor;
    $defaultClasses = "rounded-lg border bg-{$bgColor} hover:bg-{$hoverBgColor} text-{$color} px-4 py-2 cursor-pointer";
@endphp
<div class="py-3">
    <button {{ $attributes->merge(['class' => $defaultClasses.' '.$class]) }}
            {{ $attributes }}>
            {{ $slot }}
    </button>
</div>
