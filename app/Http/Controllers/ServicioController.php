<?php

namespace App\Http\Controllers;

use App\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServicioController extends Controller
{
    public function obtener(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);
        return view('servicio.obtener', [
            'servicio' => $servicio
        ]);
    }
}
