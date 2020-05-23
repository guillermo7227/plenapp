<?php

namespace App\Http\Controllers;

use App\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    public function index()
    {
        $etiquetas = Etiqueta::orderBy('texto')->get();
        return view('etiquetas.index', compact('etiquetas'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'etiquetas' => 'required'
        ]);

        $etiquetasBD = Etiqueta::all()->pluck('texto')->toArray();
        $etiquetasInput = array_map(fn($item) => trim($item), explode(',', $data['etiquetas']));
        $etiquetasNuevas = array_filter($etiquetasInput, fn($item) => !in_array($item, $etiquetasBD));

        $etiquetasNuevasParaBD = array_map(fn($item) => ['texto' => $item], $etiquetasNuevas);

        Etiqueta::insert($etiquetasNuevasParaBD);

        \Session::flash('status', ['success', 'Las etiquetas fueron guardadas satisfactoriamente.']);

        return redirect()->route('etiquetas.index');
    }


    public function destroy(Request $request, Etiqueta $etiqueta)
    {
        $etiqueta->delete();

        return redirect()->route('etiquetas.index');
    }
}
