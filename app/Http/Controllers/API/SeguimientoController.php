<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    public function show(Seguimiento $seguimiento)
    {
        return response()->json(['status' => 'success', 'data' => $seguimiento]);
    }

    public function update(Request $request, Seguimiento $seguimiento)
    {
        $input = $request->validate([
            'fecha_seguimiento' => 'required|date',
            'fecha_proximo_seguimiento' => 'required|date',
            'observaciones' => 'nullable'
        ]);

        $seguimiento->update($input);

        return response()->json(['status' => 'success', 'data' => $seguimiento, 'message' => 'Registro actualizado satisfactoriamente']);
    }
}
