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
}
