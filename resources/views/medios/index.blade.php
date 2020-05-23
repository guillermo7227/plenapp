@extends('layouts.app')
@section('content')
    <div class="px-6">

        <header class="my-4">
            <h1 class="font-bold text-3xl">Multimedia</h1>
        </header>

        <a class="link" href="{{ route('medios.create') }}">Agregar Medio/s</a>

        <main class="my-6">
            @forelse ($medios as $medio)
                {{ $medio->nombre_archivo }}
            @empty
                <p>No hay medios que mostrar</p>
            @endforelse
        </main>
    </div>
@endsection
