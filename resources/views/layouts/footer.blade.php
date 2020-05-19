
@auth()
<nav class="text-center fixed bg-secondary text-primary bottom-0 w-full p-4 mx-auto">
    <a href="{{ route('home') }}">Inicio</a> |
    <a href="{{ route('documentos.index') }}">Documentos</a> |
    <a href="{{ route('seguimientos.index') }}">Seguimientos</a> |
    <a href="{{ route('clientes.index') }}">Clientes</a>
</nav>
@endauth

