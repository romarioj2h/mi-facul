<?php

namespace App\Http\Controllers\Admin;

use App\Contactos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactosController extends Controller
{
    public function index() {
        return view('admin.contactos.index', [
            'contactos' => Contactos::orderBy('id', 'desc')->paginate(Contactos::ITEMS_POR_PAGINA)
        ]);
    }

    public function modificarEstado(Request $request, $id)
    {
        $this->validate($request, [
            'estado' => 'required|in:nueva,leida'
        ]);

        $contacto = Contactos::findOrFail($id);
        $contacto->estado = $request->input('estado');
        $contacto->save();
        return redirect()->route('admin.contactos.index');
    }
}
