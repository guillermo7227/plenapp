<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} - Ver Documento</title>

</head>
<body>
    <div id="viewer" style="height: 100vh"></div>
    <script src="{{ asset('js/pdfobject.min.js') }}"></script>
    <script>PDFObject.embed("{{ request('doc') }}", "#viewer");</script>
</body>
</html>
