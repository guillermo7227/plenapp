@extends('layouts.app')
@section('content')
    <div class="container mx-auto">

        <header>
            <h1 class="font-bold text-xl">Documentos</h1>
        </header>

        <main class="my-4">
            <ul>
                <li><a href="/viewpdf?doc=/archivos/documentos/PreciosNutricion.pdf">Precios Nutrición</a></li>
                <li><a href="/viewpdf?doc=/archivos/documentos/PreciosBelleza.pdf">Precios Belleza</a></li>
                <li><a href="/viewpdf?doc=/archivos/documentos/InfoNutricion.pdf">Información Nutrición</a></li>
                <li><a href="/viewpdf?doc=/archivos/documentos/PaquetesNutricion.pdf">Paquetes Nutrición</a></li>
            </ul>
        </main>
    </div>
@endsection
