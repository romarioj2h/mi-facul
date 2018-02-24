<?php

namespace App\Http\Controllers;

use App\ServiciosComentarios;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    public function comentar(Request $request, $id)
    {
        $this->validate($request, [
            'usuarioId' => 'numeric|required|exists:usuarios,id',
            'comentario' => 'required',
        ]);

        $comentario = new ServiciosComentarios();
        $comentario->usuariosId = $request->input('usuarioId');
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
