<?php

namespace App\Http\Controllers;

use App\Contactos;
use Illuminate\Http\Request;

class ContactosController extends Controller
{
    public function guardar(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|max:255',
            'email' => 'required|max:255|email',
            'asunto' => 'required|max:255',
            'mensaje' => 'required|max:10000',
        ]);

        $contacto = new Contactos();
        $contacto->nombre = $request->input('nombre');
        $contacto->asunto = $request->input('asunto');
        $contacto->email = $request->input('email');
        $contacto->mensaje = $request->input('mensaje');
        $contacto->estado = Contactos::NUEVA;
        $contacto->save();
        $request->session()->flash('mensage', [
            'tipo' => 'success',
            'mensage' => 'Contacto salvo con éxito!'
        ]);
        return redirect()->route('web.contacto');
    }
}
