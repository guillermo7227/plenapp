<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeguimientoRequest;
use App\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
     public function index()
    {
        $seguimientos = \Auth::user()->seguimientos->sortBy('fecha_seguimiento');

        return view('seguimientos.index', compact('seguimientos'));
    }


    public function create()
    {
        return view('seguimientos.create');
    }


    public function store(SeguimientoRequest $request)
    {
        $data = $request->validated();

        \App\Cliente::find($data['cliente_id'])->seguimiento()->create($data);

        \Session::flash('status', ['success', 'Se creó el seguimiento satisfactoriamente.']);

        return redirect()->route('seguimientos.index');
    }

    public function destroy(Seguimiento $seguimiento)
    {
        $seguimiento->delete();

        \Session::flash('status', ['success', 'Se borró el seguimiento satisfactoriamente.']);

        return redirect()->route('seguimientos.index');
    }
}
