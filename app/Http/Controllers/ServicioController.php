<?php

namespace App\Http\Controllers;

use App\Services\Firebase\Autenticacion\AutenticadorHelper;
use App\Servicios;
use App\ServiciosEvaluaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServicioController extends Controller
{
    public function obtener(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);
        $datos = [
            'servicio' => $servicio,
        ];

        if (AutenticadorHelper::estaLogueado()) {
            $usuario = AutenticadorHelper::obtenerDatos();
            $evaluacion = ServiciosEvaluaciones::obtener($id, $usuario->usuarioId);
            if ($evaluacion !== false) {
                $datos['evaluacion'] = $evaluacion;
            }
        }

        return view('servicio.obtener', $datos);
    }
}
