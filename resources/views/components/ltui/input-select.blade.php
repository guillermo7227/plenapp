@php
    $title = $title ?? '';
    $class = $class ?? '';
    $name = $name ?? '';
    $caption = $caption ?? '';
    $captionColor = $captionColor ?? 'red';
    $defaultClasses = 'border border-gray-400 px-3 py-2 rounded w-full bg-blue-100';
    $data = $data ?? [];
    $dataText = $dataText ?? '';
    $dataValue = $dataValue ?? 'id';
    $placeholder = $placeholder ?? '';
@endphp
<div class="py-3" x-data="{showTitle: false}">
    <p class="mb-2 pl-1 text-sm" x-show="showTitle">{{ $title }}</p>

    <select {{ $attributes->merge(['class' => $defaultClasses.' '.$class ]) }}
            {{ $attributes }}
            x-ref="input"
            @change="showTitle = $refs.input.selectedIndex != 0">

            @if ($placeholder)
                <option value="" disabled selected>{{ $placeholder }}</option>
            @endif

            @forelse($data as $item)
                <option value="{{ $item->$dataValue }}">{{ $item->$dataText }}</option>
            @empty
                <option value="" disabled selected>No hay items que mostrar</option>
            @endforelse

    </select>

   <p class="pl-1 mt-1 text-xs text-{{ $captionColor }}-600">{{ $caption }}</p>
</div>
