@extends('layouts.app')
@section('content')
    <div class="px-6">
        <header class="my-4">
            <h1 class="font-bold text-3xl">Agregar Documento</h1>
        </header>
        <!-- TODO: Poner mensajes de validacion -->
        <main class="my-6">
            <form action="{{ route('clientes.store') }}"
                  method="POST"
                  class="lg:w-1/2">
                @csrf
                <x-ltui.input-text :title="'Nombre del cliente'"
                                   name="nombre"
                                   required
                                   placeholder="Nombre del cliente"
                                   :caption="$errors->first('nombre')" />

                <x-ltui.input-text :title="'Teléfono del cliente'"
                                   name="telefono"
                                   placeholder="Teléfono del cliente"
                                   :caption="$errors->first('telefono')" />

                <x-ltui.textarea :title="'Dirección del cliente'"
                                 name="direccion"
                                 placeholder="Dirección del cliente"
                                 :caption="$errors->first('direccion')" />

                <x-ltui.input-text :title="'País del cliente'"
                                   name="pais"
                                   placeholder="País del cliente"
                                   :caption="$errors->first('pais')" />


                <x-ltui.rich-text :title="'Observaciones del cliente'"
                                 name="observaciones"
                                 placeholder="Notas sobre el cliente, padecimientos de salud o intereses en productos"
                                 :caption="$errors->first('observaciones')" />

            <x-ltui.rich-text :title="'Otra información del cliente'"
                               name="otra_info"
                               placeholder="Otra información relevante sobre el cliente, por ej. redes sociales, etc."
                               :caption="$errors->first('otra_info')" />

                <x-ltui.button type="submit" :bgColor="'primary'">Guardar</x-ltui.button>
            </form>
        </main>
    </div>
@endsection
