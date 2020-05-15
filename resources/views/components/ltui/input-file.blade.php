@php
    $title = $title ?? '';
    $class = $class ?? '';
    $name = $name ?? '';
    $caption = $caption ?? '';
    $captionColor = $captionColor ?? 'red';
    $accept = $accept ?? '';
    $id = rand();
    $defaultClasses = 'border px-4 py-2 rounded cursor-pointer bg-gray-200 hover:bg-gray-300';
@endphp
<div class="py-3" x-data="{
        showTitle: true,
        sub(ev) {
            const file = ev.target.value;
            const fileName = file.split('\\');
            document.getElementById('{{ $id }}-file-name').innerText = fileName[fileName.length - 1];
        }
    }">
    <p class="mb-2 pl-1 text-sm" x-show="showTitle">{{ $title }}</p>

           <a {{ $attributes->merge(['class' => $defaultClasses.' '.$class]) }}
              @click="$refs.input.click();">
               Buscar archivo
           </a>

           <span class="mx-2" id="{{ $id }}-file-name"></span>

           <div style='height: 0px;width: 0px; overflow:hidden;'>
               <input x-ref="input"
                      {{ $attributes }}
                      type="file"
                      value="upload"
                      @change="sub(event)"
                />
           </div>

           <p class="pl-1 mt-3 text-xs text-{{$captionColor}}-600">{{ $caption }}</p>
</div>
