@extends('layouts.app')
@section('content')

    <div class="px-6 ">
        <header class="my-4">
            <h1 class="font-bold text-3xl">Medios</h1>
        </header>

        <a class="link" href="{{ route('medios.create') }}">Agregar Medio</a>
        <a class="link ml-4" href="{{ route('medios.etiquetar') }}">Etiquetar Medios</a>

        @php $tags = str_replace(',,','',request()->tags); @endphp

        <div class="flex flex-wrap space-x-3 my-6">
            @forelse ($etiquetas as $etiqueta)
                <div class="bg-purple-200 rounded border text-purple-900 border-purple-400 px-2 @if ($loop->index = 1) mt-2 ml-3 @endif flex items-center">
                    <a href="{{ route('medios.index', ['tags' => $tags.','.$etiqueta->texto]) }}">
                        {{ $etiqueta->texto }}
                    </a>

                </div>
            @empty
                <p>No hay etiquetas que mostrar</p>
            @endforelse
        </div>

        @if(count($etiquetasUsadas)>0) <p>Mostrando medios de:</p> @endif
        <div class="flex flex-wrap space-x-3">
            @forelse ($etiquetasUsadas as $etiqueta)
                <div class="bg-blue-200 rounded border text-blue-900 border-blue-400 px-2 @if ($loop->index = 1) mt-2 ml-3 @endif flex items-center">
                    <a href="{{ route('medios.index', ['tags' => str_replace($etiqueta->texto, '', $tags)]) }}">
                        {{ $etiqueta->texto }}
                    </a>

                </div>
            @empty
                @if (!$medios->isEmpty())
                    <p>Seleccione una o mas etiquetas para filtrar los medios</p>
                @endif
            @endforelse
        </div>


        <main>
            <div class="my-6 grid grid-cols-2 gap-4 rounded sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                @forelse ($medios as $medio)
                    <div class="border flex items-center flex-col" style="">
                        <div class="bg-auto bg-no-repeat bg-center w-full cursor-pointer"
                             style="height:150px; max-width:150px;background-image:url('{{ $medio->miniatura }}')"
                             onclick="vmModal.$emit('open-modal', {{ $medio->id }})">
                        </div>
                    </div>
                @empty
                    <p>No hay medios que mostrar</p>
                @endforelse

            </div>

            {{ $medios->appends(request()->input())->links() }}


        </main>
    </div>

    <div id="modal"
         :class="{'hidden': !showModal}"
         @click="hideModal"
         class="fixed pin z-50 left-0 w-screen h-screen top-0 overflow-auto pt-8 pb-16 text-center px-4 flex">

         <div class="w-5/6 mx-auto p-6 rounded border overflow-auto bg-gray-100">
            <div v-if="medio" class="w-5/6 mx-auto flex flex-col items-center justify-center">
                <template v-if="medio.tipo.startsWith('image')">
                    <img :src="medio.ruta" alt="imagen medio" class="max-w-full">
                </template>
                <template v-if="medio.tipo.startsWith('video')">
                    <video :src="medio.ruta"
                           autoplay
                           controls
                           class="max-w-full">
                        Tu navegador no admite el elemento <code>video</code>.
                    </video>
                </template>
                <div class="flex justify-between w-full mt-3">
                    <template v-if="medio.etiquetas">
                        <template v-for="(etiqueta, i) in medio.etiquetas" class="text-sm">
                            <span class="text-sm">
                                @{{ etiqueta.texto+(i<medio.etiquetas.length-1 ? ', ' : '') }}
                            </span>
                        </template>
                    </template>
                    <template v-show="!medio.etiquetas" class="text-sm">
                        <span class="text-sm">No hay etiquetas</span>
                    </template>
                    <div>
                        <a href="#" @click.prevent="shareMedio"class="text-3xl">
                            <span class="iconify" data-icon="ant-design:share-alt-outlined" data-inline="false"></span>
                        </a>
                    </div>
                </div>

                <div :class="{'hidden': !preparandoParaCompatir}" class="flex">
                    <span class="mr-2">Preparando para compartir...</span>
                    <img src="{{ \H::uasset('images/cargando.gif') }}" alt="" width="25">
                </div>

            </div>
        </div>
    </div>

    <script>
        const vmModal = new Vue({
            el: '#modal',
            data() {
                return {
                    medio: null,
                    showModal: false,
                    preparandoParaCompatir: false,
                }
            },
            mounted() {
                document.querySelector('#modal').classList.remove('opacity-0');
            },
            methods: {
                hideModal(ev) {
                    if (ev.target.id=='modal') {
                        this.medio = null;
                        this.showModal = false;
                    }
                },
                loadModel(id) {
                    axios.get('/api/medios/'+id)
                    .then((res) => {
                        if (res.data.status == 'success') {
                            this.medio = res.data.data;
                            this.showModal = true;
                        }
                    })
                    .catch((err) => {
                        const msg = err.response.status+'. '+err.response.statusText;
                        alert('Error al comunicarse con el servidor. '+msg);
                    });
                },
                shareMedio() {
                    this.preparandoParaCompatir = true;

                    this.toDataURL(this.medio.ruta, (data) => {
                        const str = data.substr(0, 20);
                        const extension = str.substring(str.indexOf('/')+1, str.indexOf(';'));
                        const fileName = 'omnilife_'+this.medio.etiquetas.map((etiqueta) => etiqueta.texto).join('_');

                        const file = this.dataURLtoFile(data, fileName+'.'+extension);

                        this.preparandoParaCompatir = false;

                        const filesArray = [file];
                        if (navigator.share) {
                          navigator.share({
                            files: filesArray,
                            title: 'Recurso Omnilife',
                            text: '',
                          })
                          .then(() => console.log('Share was successful.'))
                          .catch((error) => console.log('Sharing failed', error));
                        } else {
                          console.log(`Your system doesn't support sharing files.`);
                        }

                    })
                },
                toDataURL(url, callback) {
                    var xhr = new XMLHttpRequest();
                    xhr.onload = function() {
                        var reader = new FileReader();
                        reader.onloadend = function() {
                            callback(reader.result);
                        }
                        reader.readAsDataURL(xhr.response);
                    };
                    xhr.open('GET', url);
                    xhr.responseType = 'blob';
                    xhr.send();
                },
                dataURLtoFile(dataurl, filename) {

                    var arr = dataurl.split(','),
                        mime = arr[0].match(/:(.*?);/)[1],
                        bstr = atob(arr[1]),
                        n = bstr.length,
                        u8arr = new Uint8Array(n);

                    while(n--){
                        u8arr[n] = bstr.charCodeAt(n);
                    }

                    return new File([u8arr], filename, {type:mime});
                }
            }
        });
        vmModal.$on('open-modal', (id) => vmModal.loadModel(id))
    </script>
@endsection
