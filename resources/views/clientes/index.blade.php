@extends('layouts.app')
@section('content')
    <div class="px-6">

        <header class="my-4">
            <h1 class="font-bold text-3xl">Clientes</h1>
        </header>

        <a class="link" href="{{ route('clientes.create') }}">Agregar Cliente</a>

        <main class="my-6">
            <ul class="list-disc list-inside">
                @forelse ($clientes as $cliente)
                    <li class="flex items-center">
                        <a href="#">
                            {{ $cliente->nombre }}
                        </a>

                        <div class="ml-2" x-data>
                            <a href="#"
                               class="no-underline hover:underline text-gray-500 hover:text-red-800"
                               @click.prevent="if (confirm('Borrar este cliente?')) $refs.form.submit();"
                               title="Eliminar cliente">
                                <span class="iconify" data-icon="bi:trash" data-inline="true"></span>
                            </a>
                            <form x-ref="form" action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </li>
                @empty
                    <p>No hay clientes que mostrar</p>
                @endforelse
            </ul>
        </main>
    </div>
@endsection
