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
                    <x-ltui.input-textarea :title="'Escriba las etiquetas a agregar'"
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
            @forelse ($etiquetas as $etiqueta)
                <div class="bg-purple-200 rounded border text-purple-900 border-purple-400 px-2 @if ($loop->index = 1) mt-2 @endif flex items-center">
                    {{ $etiqueta->texto }}

                    <div class="ml-2" x-data>
                        <a href="#"
                           class="no-underline hover:underline text-gray-500 hover:text-red-800"
                           @click.prevent="if (confirm('Borrar esta etiqueta?')) $refs.form.submit();"
                           title="Eliminar etiqueta">
                            <span class="iconify" data-icon="bi:trash" data-inline="true"></span>
                        </a>
                        <form x-ref="form" action="{{ route('etiquetas.destroy', $etiqueta->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>

                </div>
            @empty
                <p>No hay etiquetas que mostrar</p>
            @endforelse
        </main>
    </div>
@endsection
