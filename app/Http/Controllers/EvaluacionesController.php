<?php

namespace App\Http\Controllers;

use App\Services\Firebase\Autenticacion\AutenticadorHelper;
use App\ServiciosEnvaluaciones;
use Illuminate\Http\Request;

class EvaluacionesController extends Controller
{

    public function evaluar(Request $request, $id)
    {
        $this->validate($request, [
            'valor' => 'required|between:1,5',
        ]);

        $usuario = AutenticadorHelper::obtenerDatos();
        $evaluacion = ServiciosEnvaluaciones::obtener($id, $usuario->usuarioId);
        if ($evaluacion === false) {
            $evaluacion = new ServiciosEnvaluaciones();
            $evaluacion->usuariosId = $usuario->usuarioId;
            $evaluacion->serviciosId = $id;
        }
        $evaluacion->valor = $request->input('valor');
        $evaluacion->save();
        $request->session()->flash('mensage', [
            'tipo' => 'success',
            'mensage' => 'Gracias por su evaluación!'
        ]);

        return back();
    }
}
