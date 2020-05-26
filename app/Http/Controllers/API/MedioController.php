<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Medio;
use Illuminate\Http\Request;

class MedioController extends Controller
{
    public function show(Medio $medio)
    {
        return response()->json(['status' => 'success', 'data' => $medio]);
    }
}
