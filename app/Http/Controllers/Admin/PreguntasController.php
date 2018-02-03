<?php

namespace App\Http\Controllers\Admin;

use App\Grupos;
use App\Preguntas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreguntasController extends Controller
{
    public function index($gruposId)
    {
        $grupo = Grupos::findOrFail($gruposId);
        return view('admin.grupos.preguntas.index', [
            'preguntas' => $grupo->preguntas()->paginate(Preguntas::ITEMS_POR_PAGINA),
            'grupo' => $grupo,
        ]);
    }

    public function agregar($gruposId) {
        return view('admin.grupos.preguntas.agregar');
    }

    public function guardar(Request $request, $gruposId)
    {
        if ($request->isMethod('post') || $request->isMethod('patch')) {
            if ($request->isMethod('post')) {
                $this->validate($request, $this->obtenerReglasValidacion());
                $pregunta = new Preguntas();
            } else {
                $id = $request->input('id');
                $this->validate($request, $this->obtenerReglasValidacion($id));
                $pregunta = Preguntas::findOrFail($id);
            }

            $pregunta->gruposId = $gruposId;
            $pregunta->pregunta = $request->input('pregunta');
            $pregunta->respuesta1 = $request->input('respuesta1');
            $pregunta->respuesta2 = $request->input('respuesta2');
            $pregunta->respuesta3 = $request->input('respuesta3');
            $pregunta->respuesta4 = $request->input('respuesta4');
            $pregunta->respuestaCorrecta = $request->input('respuestaCorrecta');
            $pregunta->save();
            $request->session()->flash('mensage', [
                'tipo' => 'success',
                'mensage' => 'Pregunta salva con éxito!'
            ]);
            return redirect()->route('admin.grupos.preguntas.index', ['gruposId' => $gruposId]);
        } else {
            return view('admin.grupos.preguntas.agregar');
        }
    }

    private function obtenerReglasValidacion($id = null)
    {
        $reglas = [
            'pregunta' => 'required',
            'respuesta1' => 'required',
            'respuesta2' => 'required',
        ];

        if ($id) {
            $reglas['id'] = 'required|integer';
        }
        return $reglas;
    }

    public function editar($gruposId, $id) {
        return view('admin.grupos.preguntas.editar', [
            'pregunta' => Preguntas::findOrFail($id)
        ]);
    }

    public function borrar($gruposId, $id)
    {
        Preguntas::findOrFail($id)->delete();
        return redirect()->route('admin.grupos.preguntas.index', ['gruposId' => $gruposId]);
    }
}
