@extends('layouts.app')
@section('content')
    <div class="px-6">
        <header class="my-4">
            <h1 class="font-bold text-3xl">Agregar Medio</h1>
        </header>
        <main class="my-6">
            <form action="{{ route('medios.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="lg:w-1/2">
                @csrf
                <x-ltui.input-file :title="'Seleccione los medios a cargar'"
                                   name="medio"
                                   required
                                   multiple
                                   :route="route('medios.store')"
                                   :redirect="route('medios.index')"
                                   accept="image/x-png,image/gif,image/jpeg,video/mp4,video/x-m4v,video/*"
                                   :caption="$errors->first('medios')" />

                <!-- <x&#45;ltui.button type="submit" :bgColor="'primary'">Guardar</x&#45;ltui.button> -->
            </form>
        </main>
    </div>
@endsection
