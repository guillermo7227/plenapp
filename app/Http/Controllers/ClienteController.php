<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = \Auth::user()->clientes;

        return view('clientes.index', compact('clientes'));
    }


    public function create()
    {
        return view('clientes.create');
    }


    public function store(ClienteRequest $request)
    {
        $data = $request->validated();

        \Auth::user()->clientes()->create($data);

        return redirect()->route('clientes.index');
    }
}
