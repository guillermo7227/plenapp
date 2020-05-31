<?php

namespace App\Http\Controllers;

use App\Etiqueta;
use App\Medio;
use Illuminate\Http\Request;

class MedioController extends Controller
{
    public function index(Request $request)
    {
        $textosEtiquetas = explode(',', $request->input('tags'));
        $etiquetasUsadas = Etiqueta::whereIn('texto', $textosEtiquetas)->get();
        $etiquetasUsadasIds = $etiquetasUsadas->pluck('id');

        if (count($etiquetasUsadas) > 0) {
            $medios = Medio::whereHas('etiquetas', function($q) use ($etiquetasUsadasIds) {
                $q->whereIn('etiqueta_id', $etiquetasUsadasIds);
            })->orderBy('created_at')->paginate(20);
        } else {
            $medios = Medio::orderBy('created_at')->paginate(20);
        }

        $etiquetas = Etiqueta::whereNotIn('texto', $textosEtiquetas)->orderBy('texto')->get();

        return view('medios.index', compact('medios', 'etiquetas', 'etiquetasUsadas'));
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

        $fileName = (string)\Str::uuid();
        $fullFileName = $fileName.'.'.$request->file('medio')->extension();
        $request->file('medio')->storeAs("public/medios", $fullFileName);
        //
        Medio::create([
            'nombre_archivo' => $fullFileName,
            'tipo' => $request->file('medio')->getMimeType()
        ]);

        $mediosFolder = storage_path('app/public/medios');
        $miniaturasFolder = $mediosFolder.'/miniaturas';

        if (!file_exists($miniaturasFolder)) {
            \File::makeDirectory($miniaturasFolder, 0777, true, true);
        }

        $fthumberPath = app_path('bin/ffmpegthumbnailer');
        $videoPath = $mediosFolder.'/'.$fullFileName;
        $thumbPath = $miniaturasFolder.'/'.$fileName.'.jpeg';
        $result = shell_exec("{$fthumberPath} -i {$videoPath} -o {$thumbPath} -s 150");

        return response()->json(['status' => 'success', 'message' => 'Archivos cargado con éxito']);

    }


    public function etiquetar()
    {
        $medios = Medio::withCount('etiquetas')->orderByDesc('created_at')->paginate(20);
        return view('medios.etiquetar', compact('medios'));
    }
}
