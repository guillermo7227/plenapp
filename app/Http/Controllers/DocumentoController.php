<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function index()
    {
        return view('documentos.index');
    }

    public function create()
    {
        return view('documentos.create');
    }
}
