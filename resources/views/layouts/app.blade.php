<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased ">
    @include('layouts.header')

    <div class="container mx-auto px-3">
        @yield('content')
    </div>

    @auth()
    <nav class="text-center absolute bottom-0 w-full p-4 mx-auto">
        <a href="{{ route('home') }}">Inicio</a> |
        <a href="{{ route('documentos.index') }}">Documentos</a>
    </nav>
    @endauth

    <!-- Scripts -->
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
