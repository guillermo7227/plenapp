@extends('layouts.app')
@section('content')
    <div class="px-6">

        <header class="my-4">
            <h1 class="font-bold text-3xl">Documentos</h1>
        </header>

        <a class="link" href="{{ route('documentos.create') }}">Agregar Documento</a>

        <main class="my-6">
            <ul class="list-disc list-inside">
                @forelse ($documentos as $doc)
                    <li>
                        <a href="/viewpdf?doc=/storage/{{ $doc->ruta }}" title="{{ $doc->descripcion }}">
                            {{ $doc->nombre }}
                        </a>
                    </li>
                @empty
                    <p>No hay documentos que mostrar</p>
                @endforelse
            </ul>
        </main>
    </div>
@endsection
