<?php

namespace App\Http\Controllers;

use App\Services\Firebase\Autenticacion\AutenticadorHelper;
use App\Servicios;
use App\ServiciosEvaluaciones;
use Illuminate\Http\Request;

class EvaluacionesController extends Controller
{

    public function evaluar(Request $request, $id)
    {
        $this->validate($request, [
            'valor' => 'required|between:1,5',
        ]);

        $servicio = Servicios::findOrFail($id);
        $usuario = AutenticadorHelper::obtenerDatos();
        $evaluacion = ServiciosEvaluaciones::obtener($id, $usuario->id);
        if ($evaluacion === false) {
            $evaluacion = new ServiciosEvaluaciones();
            $evaluacion->usuariosId = $usuario->id;
            $evaluacion->serviciosId = $id;
        }
        $evaluacion->valor = $request->input('valor');
        $evaluacion->save();
        $servicio->promedioEvaluaciones = $servicio->evaluaciones->avg('valor');
        $servicio->save();
        $request->session()->flash('mensage', [
            'tipo' => 'success',
            'mensage' => 'Gracias por su evaluación!'
        ]);

        return back();
    }
}
