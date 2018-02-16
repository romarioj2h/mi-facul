<?php

namespace App\Http\Controllers;

use App\Servicios;
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

    public function obtenerServicios($id)
    {
        $grupo = ServiciosGrupos::findOrFail($id);
        return view('servicios.obtenerServicios', [
            'grupo' => $grupo
        ]);
    }
}
