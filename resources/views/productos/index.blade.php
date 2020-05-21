@extends('layouts.app')
@section('content')
    <div class="px-6">

        <header class="my-4">
            <h1 class="font-bold text-3xl">Productos</h1>
        </header>

        <main class="my-6 overflow-scroll">

            <div>

            </div>

            <table class="" style="min-width: 565px">
                <thead>
                    <tr>
                        <th class="p-2 border">DESCRIPCIÓN</th>
                        <th class="p-2 border">PUNTOS</th>
                        <th class="p-2 border">PRECIO DISTRB.</th>
                        <th class="p-2 border">PRECIO PUBLICO</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $producto)
                        <tr>
                            <td class="p-2 border">{{ $producto->descripcion }}</td>
                            <td class="p-2 border text-center">{{ $producto->puntos }}</td>
                            <td class="p-2 border text-right">
                                $ {{ number_format((float)$producto->precioDistribuidor) }}
                            </td>
                            <td class="p-2 border text-right">
                                $ {{ number_format((float)$producto->precioPublico) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No hay productos que mostrar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </main>
    </div>
@endsection
