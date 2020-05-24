@extends('layouts.app')
@section('content')
    <div class="px-6">

        <header class="my-4">
            <h1 class="font-bold text-3xl">Medios</h1>
        </header>

        <a class="link" href="{{ route('medios.create') }}">Agregar Medio</a>

        <main class="my-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @forelse ($medios as $medio)
                <div class="border" style="">
                    <div class="bg-cover bg-center" style="height:150px; width:150px;background-image:url('{{ $medio->ruta }}')">
                    </div>
                    <div>
                        filetag, tagfile
                    </div>
                </div>
            @empty
                <p>No hay documentos que mostrar</p>
            @endforelse
        </main>
    </div>
@endsection
