<?php

namespace App\Http\Controllers\Admin;

use App\Servicios;
use App\ServiciosGrupos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiciosController extends Controller
{
    public function index()
    {
        return view('admin.servicios.index', [
            'servicios' => Servicios::paginate(Servicios::ITEMS_POR_PAGINA)
        ]);
    }

    public function agregar()
    {
        return view('admin.servicios.agregar', [
            'grupos' => ServiciosGrupos::all()
        ]);
    }

    public function editar($id)
    {
        return view('admin.servicios.editar', [
            'servicio' => Servicios::findOrFail($id),
            'grupos' => ServiciosGrupos::all()
        ]);
    }

    public function borrar($id)
    {
        Servicios::findOrFail($id)->delete();
        return redirect()->route('admin.servicios.index');
    }
}
