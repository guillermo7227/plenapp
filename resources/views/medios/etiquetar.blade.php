@extends('layouts.app')
@section('content')
    <div class="px-6">
        <header class="my-4">
            <h1 class="font-bold text-3xl">Etiquetar Medios</h1>
        </header>
        <main class="my-6">
            <div class="flex space-x-3">
                @forelse($medios as $medio)
                    <div class="border">
                        <img src="{{$medio->miniatura}}">
                    </div>
                @empty
                    No hay medios para etiquetar
                @endforelse
            </div>

            {{ $medios->links() }}
        </main>
    </div>
@endsection
