@php
    $title = $title ?? '';
    $class = $class ?? '';
    $name = $name ?? '';
    $caption = $caption ?? '';
    $captionColor = $captionColor ?? 'red';
    $defaultClasses = 'border border-gray-400 px-3 py-2 rounded w-full bg-blue-100';
    $id = $attributes['id'] ?? 'A'.Str::random();
    $events = $events ?? '';
    $cClass = $cClass ?? '';
@endphp
<div class="py-3 w-full {{ $cClass }}"
     x-data="{
        showLabel:false,
        checkValue() { if (this.$refs.input.value) this.showLabel=true }
     }"
     x-init="checkValue()"
    @foreach ((array)json_decode($events) as $key => $value)
        {{'@'.$id}}-{{ $key }}.window="{{$value}}"
    @endforeach
>
    <p class="mb-2 pl-1 text-sm" x-show="showLabel">{{ $title }}</p>
    <textarea {{ $attributes->merge(['class' => $defaultClasses.' '.$class]) }}
              rows="5"
              id="{{ $id }}"
              {{ $attributes }}
              x-ref="input"
              x-on:input="showLabel = $refs.input.value.length > 0"
    ></textarea>
    <p class="pl-1 mt-1 text-xs text-{{ $captionColor }}-600">{{ $caption }}</p>
</div>
