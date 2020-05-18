@extends('layouts.app')
@section('content')
    <div class="px-6">

        <header class="my-4">
            <h1 class="font-bold text-3xl">Seguimientos</h1>
        </header>

        <a class="link" href="{{ route('seguimientos.create') }}">Agregar Seguimiento</a>

        <main class="my-6">
            <ul class="list-disc list-inside">
                @forelse ($seguimientos as $seg)
                    <li class="flex items-center">
                        <a href="#">
                            {{ $seg->cliente->nombre }} - {{ $seg->fecha_seguimiento }}
                        </a>

                        <div class="ml-2" x-data>
                            <a href="#"
                               class="no-underline hover:underline text-gray-500 hover:text-red-800"
                               @click.prevent="if (confirm('Borrar este seguimiento?')) $refs.form.submit();"
                               title="Eliminar seguimiento">
                                <span class="iconify" data-icon="bi:trash" data-inline="true"></span>
                            </a>
                            <form x-ref="form" action="{{ route('seguimientos.destroy', $seg->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </li>
                @empty
                    <p>No hay seguimientos que mostrar</p>
                @endforelse
            </ul>
        </main>
    </div>
@endsection
