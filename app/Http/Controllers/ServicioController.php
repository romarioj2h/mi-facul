<?php

namespace App\Http\Controllers;

use App\Servicios;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function obtener($id)
    {
        $servicio = Servicios ::findOrFail($id);
        return view('servicio.obtener', [
            'servicio' => $servicio
        ]);
    }
}
