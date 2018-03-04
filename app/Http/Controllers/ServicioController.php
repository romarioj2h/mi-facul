<?php

namespace App\Http\Controllers;

use App\Helpers\StringsHelper;
use App\Services\Firebase\Autenticacion\AutenticadorHelper;
use App\Servicios;
use App\ServiciosEvaluaciones;
use App\ServiciosGrupos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServicioController extends Controller
{
    public function obtener(Request $request, $id)
    {
        $servicio = Servicios::where('estado', '=', Servicios::ESTADO_APROBADO)->findOrFail($id);
        $datos = [
            'servicio' => $servicio,
        ];

        if (AutenticadorHelper::estaLogueado()) {
            $usuario = AutenticadorHelper::obtenerDatos();
            $evaluacion = ServiciosEvaluaciones::obtener($id, $usuario->id);
            if ($evaluacion !== false) {
                $datos['evaluacion'] = $evaluacion;
            }
        }

        return view('servicio.obtener', $datos);
    }

    public function agregar()
    {
        return view('servicio.agregar', [
            'grupos' => ServiciosGrupos::all()
        ]);
    }

    public function guardar(Request $request)
    {
        $usuario = AutenticadorHelper::obtenerDatos();
        $grupo = ServiciosGrupos::findOrFail($request->input('serviciosGruposId'));
        if ($request->isMethod('post')) {
            $this->validate($request, $this->obtenerReglasValidacion());
            $servicio = new Servicios();
        } else {
            $id = $request->input('id');
            $this->validate($request, $this->obtenerReglasValidacion($id));
            $servicio = Servicios::findOrFail($id);
        }

        $servicio->nombre = $request->input('nombre');
        $servicio->slug = StringsHelper::generarSlug($request->input('nombre'));
        $servicio->descripcion = $request->input('descripcion');
        $servicio->telefonos = $request->input('telefonos');
        $servicio->whatsapp = $request->input('whatsapp');
        $servicio->facebook = $request->input('facebook');
        $servicio->direccion = $request->input('direccion');
        $servicio->localidad = $request->input('localidad');
        $servicio->serviciosGruposId = $grupo->id;
        $servicio->usuariosId = $usuario->id;
        $servicio->save();
        $request->session()->flash('mensage', [
            'tipo' => 'success',
            'mensage' => 'El servicio está pediente de moderación, en algunas horas ya lo tenemos! '
        ]);
        return redirect()->route('web.servicios.obtenerGrupos');
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
