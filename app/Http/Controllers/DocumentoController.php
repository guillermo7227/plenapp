<?php

namespace App\Http\Controllers;

use App\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function index()
    {
        return view('documentos.index', ['documentos' => Documento::all()]);
    }

    public function create()
    {
        return view('documentos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'documento' => 'required|file|mimes:pdf',
        ]);

        $ruta = $request->file('documento')->store("public/documentos/".\Auth::id());

        unset($data['documento']);
        $data['user_id'] = \Auth::id();
        $data['ruta'] = str_replace('public/', '', $ruta);

        Documento::create($data);

        return redirect()->route('documentos.index');
    }


    public function destroy(Documento $documento)
    {
        $documento->delete();

        return redirect()->route('documentos.index');
    }
}
