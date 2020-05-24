<?php

namespace App\Http\Controllers;

use App\Medio;
use Illuminate\Http\Request;

class MedioController extends Controller
{
    public function index()
    {
        $medios = Medio::all();

        return view('medios.index', compact('medios'));
    }

    public function create()
    {
        return view('medios.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'medio' => 'required',
        ]);

        $fileName = (string)\Str::uuid().'.'.$request->file('medio')->extension();
        $request->file('medio')->storeAs("public/medios", $fileName);

        Medio::create([
            'nombre_archivo' => $fileName,
            'tipo' => $request->file('medio')->getMimeType()
        ]);

        return response()->json(['status' => 'success', 'message' => 'Archivos cargado con éxito']);

    }
}
