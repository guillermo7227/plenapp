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
                    <li class="flex items-center">
                        <a href="/viewpdf?doc=/storage/{{ $doc->ruta }}" title="{{ $doc->descripcion }}">
                            {{ $doc->nombre }}
                        </a>

                        <div class="ml-2" x-data>
                            <a href="#"
                               class="no-underline hover:underline text-gray-500 hover:text-red-800"
                               @click.prevent="if (confirm('Borrar este documento?')) $refs.form.submit();"
                               title="Eliminar documento">
                                <span class="iconify" data-icon="bi:trash" data-inline="true"></span>
                            </a>
                            <form x-ref="form" action="{{ route('documentos.destroy', $doc->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </li>
                @empty
                    <p>No hay documentos que mostrar</p>
                @endforelse
            </ul>
        </main>
    </div>
@endsection
