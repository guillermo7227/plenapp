@extends('layouts.app')
@section('content')
    <div class="px-6">

        <header class="my-4">
            <h1 class="font-bold text-3xl">Documentos</h1>
        </header>

        <a class="link" href="{{ route('documentos.create') }}">Agregar Documento</a>

        <main class="my-6">
            <ul class="list-disc list-inside">
                <li><a href="/viewpdf?doc=/archivos/documentos/PreciosNutricion.pdf">Precios Nutrición</a></li>
                <li><a href="/viewpdf?doc=/archivos/documentos/PreciosBelleza.pdf">Precios Belleza</a></li>
                <li><a href="/viewpdf?doc=/archivos/documentos/InfoNutricion.pdf">Información Nutrición</a></li>
                <li><a href="/viewpdf?doc=/archivos/documentos/PaquetesNutricion.pdf">Paquetes Nutrición</a></li>
            </ul>
        </main>
    </div>
@endsection
