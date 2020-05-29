<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Iconos -->
    <link rel="apple-touch-icon" sizes="76x76" href="/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icons/favicon-16x16.png">
    <link rel="manifest" href="/images/icons/site.webmanifest">
    <link rel="mask-icon" href="/images/icons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/images/icons/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="msapplication-config" content="/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> -->

    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css" crossorigin="anonymous">
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    <link rel="stylesheet" href="{{ \H::uasset('css/quill.snow.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 h-screen antialiased">

    <x-ltui.feedback />

    @include('layouts.header')

    <div class="container mx-auto px-3 mb-40">
        @yield('content')
        <x-calc.calc />
    </div>


    @include('layouts.footer')

    <!-- Scripts -->
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ \H::uasset('js/app.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
