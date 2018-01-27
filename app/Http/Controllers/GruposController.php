<?php

namespace App\Http\Controllers;

use App\Grupos;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    public function index()
    {
        return view('index', [
            'grupos' => Grupos::all()
        ]);
    }

    public function obtenerPreguntas($id)
    {
        $grupo = Grupos::find($id);
        return view('grupos.preguntas', [
            'preguntas' => $grupo->preguntas()->get()
        ]);
    }
}
