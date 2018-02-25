<?php

namespace App\Http\Controllers;

use App\Services\Firebase\Autenticacion\AutenticadorHelper;
use App\ServiciosComentarios;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    public function comentar(Request $request, $id)
    {
        $this->validate($request, [
            'comentario' => 'required',
        ]);

        $comentario = new ServiciosComentarios();
        $comentario->usuariosId = AutenticadorHelper::obtenerDatos()->usuarioId;
        $comentario->serviciosId = $id;
        $comentario->comentario = $request->input('comentario');
        $comentario->save();
        $request->session()->flash('mensage', [
            'tipo' => 'success',
            'mensage' => 'Gracias por su comentario!'
        ]);

        return back();
    }
}
