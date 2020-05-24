@php
    $title = $title ?? '';
    $class = $class ?? '';
    $name = $name ?? 'file';
    $caption = $caption ?? '';
    $captionColor = $captionColor ?? 'red';
    $accept = $accept ?? '';
    $id = rand();
    $defaultClasses = 'border px-4 py-2 rounded cursor-pointer bg-gray-200 hover:bg-gray-300';
    $route = $route ?? '/';
    $redirect = $redirect ?? '/';
@endphp
<div class="py-3" x-data="{
        showTitle: true,
        sub(ev) {
            const file = ev.target.files[0];
            const fileName = file.split('\\');
            document.getElementById('{{ $id }}-file-name').innerText = fileName[fileName.length - 1];
        },
        fileList: [],
        currentFileIndex: 0,
        uploadComplete() { return this.fileList.length == this.currentFileIndex; },
        progressHandler(event) {
            const percent = (event.loaded / event.total) * 100;
            this.$refs['progress-bar'+this.currentFileIndex].value = Math.round(percent);
        },
        completeHandler(event) {
            this.currentFileIndex++;
            this.processNextFile();
        },
        processNextFile() {
            this.fileList = this.$refs.input.files;
            if (this.currentFileIndex < this.fileList.length) {
                this.uploadFile(this.currentFileIndex);
            } else {
                let segundos = 10;
                let timer = setInterval(() => {
                    let msg = 'Proceso terminado. Se cargaron '+this.fileList.length+' archivos. ';
                    msg += '\n¡Gracias por mejorar PlenApp!. Se redireccionará en ' + segundos-- + ' segundos.';
                    this.$refs.status.innerText = msg;
                }, 1000);
                setTimeout(() => {
                    clearInterval(timer);
                    window.location = '{{ $redirect }}';
                }, segundos * 1000);
            }
        },
        errorHandler(event) { console.log('error') },
        abortHandler(event) { console.log('abort') },
        uploadFile(index) {
            const file = this.fileList.item(index);
            const formdata = new FormData();
            formdata.append('_token', '{{ csrf_token() }}');
            formdata.append('{{ $name }}', file);
            //alert(file.name+' | '+file.size+' | '+file.type);
            const ajax = new XMLHttpRequest();
            ajax.upload.addEventListener('progress', this.progressHandler.bind(this), false);
            ajax.addEventListener('load', this.completeHandler.bind(this), false);
            ajax.addEventListener('error', this.errorHandler.bind(this), false);
            ajax.addEventListener('abort', this.abortHandler.bind(this), false);
            ajax.open('POST', '{{ $route }}')
            ajax.send(formdata);
        }
    }">
    <p class="mb-2 pl-1 text-sm" x-show="showTitle">{{ $title }}</p>

           <a {{ $attributes->merge(['class' => $defaultClasses.' '.$class]) }}
              @click="$refs.input.click();">
               Buscar archivo
           </a>


           <div style='height: 0px;width: 0px; overflow:hidden;'>
               <input x-ref="input"
                      {{ $attributes }}
                      type="file"
                      value="upload"
                      @change="processNextFile"
                />
           </div>
           <div class="mt-3" x-show="fileList.length > 0">
               <h5 x-ref="status" :class="{'text-green-800 font-bold': uploadComplete()}">
                   Cargando archivos...
               </h5>
               <template x-for="index in [...Array(fileList.length).keys()]">
                   <div class="flex w-full items-center text-gray-700 text-sm border-b-2 mt-2">
                       <div :x-text="`fileList.item(index).name`"
                          class="whitespace-pre overflow-hidden w-1/2 pr-2"></div>
                       <progress :x-ref="'progress-bar'+index"
                                 value="0"
                                 max="100"
                                 class="w-1/2 px-2">
                       </progress>
                   </div>
               </template>
           </div>

           <p class="pl-1 mt-3 text-xs text-{{$captionColor}}-600">{{ $caption }}</p>
</div>
