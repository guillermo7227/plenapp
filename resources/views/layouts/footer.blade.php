
@auth()
<nav class="text-center fixed bg-blue-900 text-gray-200 bottom-0 w-full px-4 py-3 mx-auto flex justify-between text-2xl">
    <a href="{{ route('home') }}" title="Inicio">
        <span class="iconify" data-icon="bx:bx-home-circle" data-inline="false"></span>
    </a>
    <a href="{{ route('documentos.index') }}" title="Documentos">
        <span class="iconify" data-icon="et:documents" data-inline="false"></span>
    </a>
    <a href="{{ route('seguimientos.index') }}" title="Seguimientos">
        <span class="iconify" data-icon="gridicons:reader-following" data-inline="false"></span>
    </a>
    <a href="{{ route('clientes.index') }}" title="Clientes">
        <span class="iconify" data-icon="fa-solid:people-carry" data-inline="false"></span>
    </a>
    <a href="{{ route('productos.index') }}" title="Productos">
        <span class="iconify" data-icon="gridicons:product" data-inline="false"></span>
    </a>
    <a href="{{ route('etiquetas.index') }}" title="Etiquetas">
        <span class="iconify" data-icon="ant-design:tag-outlined" data-inline="false"></span>
    </a>
    <a href="{{ route('medios.index') }}" title="Medios">
        <span class="iconify" data-icon="ic:baseline-perm-media" data-inline="false"></span>
    </a>
    <a href="javascript:void(0)"
       onclick="document.querySelector('#calc').classList.toggle('hidden')"
       title="Calculadora">
        <span class="iconify" data-icon="ant-design:calculator-outlined" data-inline="false"></span>
    </a>
</nav>
@endauth

