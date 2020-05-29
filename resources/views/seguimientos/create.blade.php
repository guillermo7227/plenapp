@extends('layouts.app')
@section('content')
    <div class="px-6">
        <header class="my-4">
            <h1 class="font-bold text-3xl">Agregar Seguimiento</h1>
        </header>
        <!-- TODO: Poner mensajes de validacion -->
        <main class="my-6">
            <form action="{{ route('seguimientos.store') }}"
                  method="POST"
                  class="lg:w-1/2">
                @csrf


                <x-ltui.input-select :title="'Cliente'"
                                     required
                                     name="cliente_id"
                                     :data="\Auth::user()->clientes"
                                     :data-text="'nombre'"
                                     :data-value="'id'"
                                     :placeholder="'Seleccione un cliente'"
                                     :caption="$errors->first('cliente_id')"/>

                <x-ltui.input-date :title="'Fecha de compra'"
                                   required
                                   value="{{ now()->format('Y-m-d') }}"
                                   name="fecha_compra"
                                   :caption="$errors->first('fecha_compra')"/>

                <x-ltui.input-date :title="'Fecha de próximo seguimiento'"
                                   value="{{ now()->addDays(15)->format('Y-m-d') }}"
                                   name="fecha_proximo_seguimiento"
                                   :caption="$errors->first('fecha_proximo_seguimiento')"/>

                <x-ltui.rich-text :title="'Observaciones'"
                                  name="observaciones"
                                  placeholder="Escriba observaciones y/o notas..."
                                  :caption="$errors->first('observaciones')" />


                <x-ltui.button type="submit" :bgColor="'primary'">Guardar</x-ltui.button>
            </form>
        </main>
    </div>
@endsection
