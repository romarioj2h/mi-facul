<?php

namespace App\Http\Controllers\Admin;

use App\Grupos;
use App\Preguntas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GruposController extends Controller
{
    public function index() {
        return view('admin.grupos.index', [
            'grupos' => Grupos::paginate(Grupos::ITEMS_POR_PAGINA)
        ]);
    }

    public function editar($id)
    {
        return view('admin.grupos.editar', [
            'grupo' => Grupos::findOrFail($id)
        ]);
    }

    public function agregar()
    {
        return view('admin.grupos.agregar');
    }

    public function guardar(Request $request)
    {
        if ($request->isMethod('post') || $request->isMethod('patch')) {
            if ($request->isMethod('post')) {
                $this->validate($request, $this->obtenerReglasValidacion());
                $grupo = new Grupos();
            } else {
                $id = $request->input('id');
                $this->validate($request, $this->obtenerReglasValidacion($id));
                $grupo = Grupos::findOrFail($id);
            }

            $grupo->nombre = $request->input('nombre');
            $grupo->descripcion = $request->input('descripcion');
            $grupo->idioma = $request->input('idioma');
            $grupo->save();
            $request->session()->flash('mensage', [
                'tipo' => 'success',
                'mensage' => 'Grupo salvo con éxito!'
            ]);
            return redirect()->route('admin.grupos.index');
        } else {
            return view('admin.grupos.agregar');
        }
    }

    private function obtenerReglasValidacion($id = null)
    {
        $reglas = [
            'nombre' => 'required|max:255',
        ];

        if ($id) {
            $reglas['id'] = 'required|integer';
        }
        return $reglas;
    }

    public function borrar($id)
    {
        Preguntas::where('gruposId', $id)->delete();
        Grupos::findOrFail($id)->delete();
        return redirect()->route('admin.grupos.index');
    }
}
