@php $etiquetas = $etiquetas ?? [] @endphp
<div class="flex flex-wrap space-x-3">
    @forelse ($etiquetas as $etiqueta)
        <div class="bg-purple-200 rounded border text-purple-900 border-purple-400 px-2 @if ($loop->index = 1) mt-2 ml-3 @endif flex items-center">
            {{ $etiqueta->texto }}

            <div class="ml-2" x-data>
                <a href="#"
                   class="no-underline hover:underline text-gray-500 hover:text-red-800"
                   @click.prevent="if (confirm('Borrar esta etiqueta?')) $refs.form.submit();"
                   title="Eliminar etiqueta">
                    <span class="iconify" data-icon="bi:trash" data-inline="true"></span>
                </a>
                <form x-ref="form" action="{{ route('etiquetas.destroy', $etiqueta->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>

        </div>
    @empty
        <p>No hay etiquetas que mostrar</p>
    @endforelse
</div>

