<?php

namespace App\Http\Controllers;

use App\ServiciosGrupos;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function obtenerGrupos()
    {
        return view('servicios.obtenerGrupos', [
            'grupos' => ServiciosGrupos::all()
        ]);
    }
}
