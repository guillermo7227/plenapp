@extends('layouts.app')
@section('content')
    <div class="px-6">
        <header class="my-4">
            <h1 class="font-bold text-3xl">Agregar Documento</h1>
        </header>
        <!-- TODO: Poner mensajes de validacion -->
        <main class="my-6">
            <form action="{{ route('documentos.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="lg:w-1/2">
                @csrf
                <x-ltui.input-text :title="'Nombre del documento'"
                                   name="nombre"
                                   required
                                   placeholder="Nombre del documento"
                                   :caption="$errors->first('nombre')" />

                <x-ltui.textarea :title="'Descripción del documento'"
                                 name="descripcion"
                                 required
                                 placeholder="Descripción del documento"
                                 :caption="$errors->first('descripcion')" />

                <x-ltui.input-file :title="'Seleccione el documento a cargar'"
                                   name="documento"
                                   required
                                   accept="application/pdf"
                                   :caption="$errors->first('documento')" />

                <x-ltui.button type="submit" :bgColor="'primary'">Guardar</x-ltui.button>
            </form>
        </main>
    </div>
@endsection
