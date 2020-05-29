@extends('layouts.app')
@section('content')
    <div class="px-6">

        <header class="my-4">
            <h1 class="font-bold text-3xl">Seguimientos</h1>
        </header>

        <a class="link" href="{{ route('seguimientos.create') }}">Agregar Seguimiento</a>

        <main class="my-6">
            <ul class="list-disc list-inside">
                @forelse ($seguimientos as $seg)
                    <li class="flex items-center">
                        <a href="#">
                            {{ $seg->cliente->nombre }} -
                            <span class="text-gray-600">@fecha($seg->fecha_proximo_seguimiento)</span>
                        </a>

                        <div class="ml-2" x-data>
                            <a href="#"
                               class="no-underline hover:underline text-green-500 hover:text-green-800"
                               onclick="vmModal.$emit('open-modal', {{ $seg->id }})"
                               title="Marcar seguimiento Hecho">
                               <span class="iconify" data-icon="ant-design:check-outlined" data-inline="false"></span>
                            </a>
                        </div>

                        <div class="ml-2" x-data>
                            <a href="#"
                               class="no-underline hover:underline text-gray-500 hover:text-red-800"
                               @click.prevent="if (confirm('Borrar este seguimiento?')) $refs.form.submit();"
                               title="Eliminar seguimiento">
                                <span class="iconify" data-icon="bi:trash" data-inline="true"></span>
                            </a>
                            <x-ltui.form :method="'delete'"
                                         class="hidden"
                                         x-ref="form"
                                         action="{{ route('seguimientos.destroy', $seg->id) }}" />
                        </div>
                    </li>
                @empty
                    <p>No hay seguimientos que mostrar</p>
                @endforelse
            </ul>
        </main>



        <div id="modal"
             :class="{'hidden': !showModal}"
             @click="hideModal"
             class="fixed pin z-50 left-0 w-screen h-screen top-0 overflow-auto pt-8 pb-16 text-center px-4 flex">

            <div class="w-5/6 mx-auto py-6 px-1 rounded border overflow-auto bg-gray-100">
                <div v-if="seguimiento" class="w-5/6 mx-auto flex flex-col items-center justify-center">
                    <h1>
                        <span class="text-sm">Marcar seguimiento</span> <br>
                        <span class="font-bold">@{{ seguimiento.cliente.nombre }}</span> <br>
                        <span class="text-gray-700">(@{{ seguimiento.cliente.telefono }})</span>
                    </h1>

                    <div class="text-left w-full flex flex-col">
                        <div class="text-left w-full grid grid-cols-1 md:grid-cols-2">
                            <x-ltui.input-text v-model="seguimiento.fecha_compra"
                                               :title="'Fecha de compra:'"
                                               readonly/>

                            <x-ltui.input-date v-model="seguimiento.fecha_proximo_seguimiento"
                                               :title="'Fecha próximo seguimiento'" :c-class="'md:ml-3'" />
                        </div>

                        <x-ltui.rich-text :title="'Observaciones'"
                                          v-bind:text="seguimiento.observaciones"
                                          v-on:input="richTextChange"
                                          placeholder="Escriba observaciones y notas..." />

                        <x-ltui.button class="w-full" :bg-color="'primary'" @click="submit">
                            Guardar
                        </x-ltui.button>

                        <h2 class="font-bold">Notas del cliente</h2>
                        <p v-html="seguimiento.cliente.observaciones"></p>
                        <h2 class="font-bold font-sm">Otras notas</h2>
                        <p v-html="seguimiento.cliente.otra_info"></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        const vmModal = new Vue({
            el: '#modal',
            data() {
                return {
                    seguimiento: null,
                    showModal: false,
                    fecha: null,
                }
            },
            methods: {
                richTextChange(ev) {
                    this.seguimiento.observaciones = ev.target.getAttribute('text');
                },
                hideModal(ev) {
                    if (ev.target.id=='modal') {
                        this.seguimiento = null;
                        this.showModal = false;
                    }
                },
                loadModel(id) {
                    NProgress.start();
                    axios.get('/api/seguimientos/'+id)
                    .then((res) => {
                        if (res.data.status == 'success') {
                            this.seguimiento = res.data.data;
                            this.showModal = true;
                            NProgress.done();
                        }
                    })
                    .catch((err) => {
                        const msg = err.response.status+'. '+err.response.statusText;
                        alert('Error al comunicarse con el servidor. '+msg);
                    });
                },
                submit() {
                    this.seguimiento.fecha_seguimiento = moment().format('YYYY-MM-DD');
                    NProgress.start();
                    axios.put('/api/seguimientos/'+this.seguimiento.id, this.seguimiento)
                        .then((res) => {
                            NProgress.done();
                            if (res.data.status == 'success') {
                                return window.location = "{{ route('seguimientos.index') }}";
                            }
                            alert(res.data.message);
                        })
                        .catch((err) => {
                            const msg = err.response.status+'. '+err.response.statusText;
                            alert('Error al comunicarse con el servidor. '+msg);
                        });
                }
            }
        });
        vmModal.$on('open-modal', (id) => vmModal.loadModel(id))
    </script>

@endsection
