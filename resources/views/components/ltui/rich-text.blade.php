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
<div class="py-3 w-full {{ $cClass }} ltui-component"
     x-data="{
        showLabel:false,
        quill: null,
        quillValue: '',
        initQuill() {
          const placeholder = `{{ $attributes['placeholder'] ?? 'Escriba un texto...' }}`;
          this.quill = new Quill('#{{ $id }}', {
              modules: {
                  toolbar: [
                      [{ header: [1, 2, false] }],
                      ['bold', 'italic', 'underline', { 'align': [] }, 'code-block'],
                      ['blockquote', { 'list': 'ordered'}, { 'list': 'bullet' },
                          { 'indent': '-1'}, { 'indent': '+1' }, 'link'],
                  ]
              },
              placeholder,
              theme: 'snow'
          });
          const delta = this.quill.clipboard.convert(this.$refs.input.getAttribute('text'));
          this.quill.setContents(delta);
          this.$refs.richtext.oninput = () => {
            this.quillValue = this.quill.root.innerHTML;
            this.showLabel = this.quill.root.innerText.length > 1;
            this.quill.root.setAttribute('text', this.quill.root.innerHTML);
          };
          this.$refs.richtext.dispatchEvent(new CustomEvent('input'));
        },
     }"
     x-init="initQuill()"
    @foreach ((array)json_decode($events) as $key => $value)
        {{'@'.$id}}-{{ $key }}.window="{{$value}}"
    @endforeach
>
    <p class="mb-2 pl-1 text-sm" x-show="showLabel">{{ $title }}</p>

    <div {{ $attributes->merge(['class' => $defaultClasses.' '.$class]) }}
         style="height: 200px;"
         id="{{ $id }}"
         x-ref="richtext">
    </div>

    <p class="pl-1 mt-1 text-xs text-{{ $captionColor }}-600">{{ $caption }}</p>

    <input type="hidden" class="richtext" x-ref="input" x-bind:value="quillValue" {{ $attributes }}>
</div>
