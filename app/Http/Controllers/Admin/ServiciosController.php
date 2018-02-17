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

    public function guardar(Request $request)
    {
        if ($request->isMethod('post') || $request->isMethod('patch')) {
            if ($request->isMethod('post')) {
                $this->validate($request, $this->obtenerReglasValidacion());
                $servicio = new Servicios();
            } else {
                $id = $request->input('id');
                $this->validate($request, $this->obtenerReglasValidacion($id));
                $servicio = Servicios::findOrFail($id);
            }

            $servicio->nombre = $request->input('nombre');
            $servicio->descripcion = $request->input('descripcion');
            $servicio->telefonos = $request->input('telefonos');
            $servicio->direccion = $request->input('direccion');
            $servicio->localidad = $request->input('localidad');
            $servicio->serviciosGruposId = $request->input('serviciosGruposId');
            $servicio->save();
            $request->session()->flash('mensage', [
                'tipo' => 'success',
                'mensage' => 'Servicio salvo con éxito!'
            ]);
            return redirect()->route('admin.servicios.index');
        } else {
            return view('admin.servicios.agregar');
        }
    }

    private function obtenerReglasValidacion($id = null)
    {
        $reglas = [
            'nombre' => 'required',
            'telefonos' => 'required',
            'localidad' => 'required',
            'serviciosGruposId' => 'required',
        ];

        if ($id) {
            $reglas['id'] = 'required|integer';
        }
        return $reglas;
    }
}
