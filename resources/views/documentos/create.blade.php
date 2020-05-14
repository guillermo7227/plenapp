@extends('layouts.app')
@section('content')
    <div class="px-6">

        <header class="my-4">
            <h1 class="font-bold text-3xl">Agregar Documento</h1>
        </header>
        <!-- ojo! hacer los campos required -->
        <main class="my-6">
            <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-laratailui.input-text :title="'Nombre del documento'"
                                         :name="'nombre'"
                                         :placeholder="'Nombre del documento'"
                />

                <x-laratailui.input-textarea :title="'Descripción del documento'"
                                             :name="'descripcion'"
                                             :placeholder="'Descripción del documento'"
                />

                <x-laratailui.input-file :title="'Seleccione el documento a cargar'"
                                         :accept="'application/pdf'"
                                         :name="'documento'"
                />
            </form>
        </main>
    </div>
@endsection
