@extends('layouts.app')
@section('content')
    <div class="px-6">

        <header class="my-4">
            <h1 class="font-bold text-3xl">Etiquetas</h1>
        </header>

        <div x-data="{showInput: false}">
            <a class="link" @click.prevent="showInput = true">
                Agregar Etiquetas
            </a>


            <div id="add-etiqueta" x-show="showInput">
                <form action="{{ route('etiquetas.store') }}" method="POST">
                    @csrf
                    @php $events = json_encode(['clear-input' => "\$refs.input.value = ''"]); @endphp
                    <x-ltui.textarea :title="'Escriba las etiquetas a agregar'"
                                     name="etiquetas"
                                     id="etiquetas"
                                     required
                                     :events="$events"
                                     placeholder="Escriba las etiquetas. P.ej. aqtúa, sistema nervioso, omniplus, testimonio"
                                     :caption="$errors->first('etiquetas')" />

                    <div class="flex">
                        <x-ltui.button type="button"
                                       class="mr-2"
                                       :color="'gray-800'"
                                       :bgColor="'secondary'"
                                       @click.prevent="showInput = false; $dispatch('etiquetas-clear-input')">
                                   Cancelar
                        </x-ltui.button>
                        <x-ltui.button type="submit" :bgColor="'primary'">Guardar</x-ltui.button>
                    </div>
                </form>
            </div>
        </div>

        <main class="my-6 flex flex-wrap space-x-2 space-y-2 text-sm">
            <x-etiquetas :etiquetas="$etiquetas"/>
        </main>
    </div>
@endsection
