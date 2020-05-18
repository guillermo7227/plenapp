<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeguimientoRequest;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
     public function index()
    {
        $seguimientos = \Auth::user()->seguimientos;

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

        return redirect()->route('seguimientos.index');
    }
}
