<?php

namespace App\Http\Controllers;

use App\Helpers\StringsHelper;
use App\Services\Firebase\Autenticacion\AutenticadorHelper;
use App\Servicios;
use App\ServiciosEvaluaciones;
use App\ServiciosGrupos;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\UnauthorizedException;

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

    public function editar(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);
        if ($servicio->usuariosId != AutenticadorHelper::obtenerDatos()->id) {
            return redirect()->route('web.index');
        }
        return view('servicio.editar', [
            'grupos' => ServiciosGrupos::all(),
            'servicio' => $servicio
        ]);
    }

    public function guardar(Request $request)
    {
        $usuario = AutenticadorHelper::obtenerDatos();
        $grupo = ServiciosGrupos::findOrFail($request->input('serviciosGruposId'));
        if ($request->isMethod('post')) {
            $this->validate($request, $this->obtenerReglasValidacion());
            $servicio = new Servicios();
            $mensage = 'El servicio está pediente de moderación, en algunas horas ya lo tenemos!';
        } else {
            $id = $request->input('id');
            $this->validate($request, $this->obtenerReglasValidacion($id));
            $servicio = Servicios::findOrFail($id);
            if ($servicio->estado == Servicios::ESTADO_RECHAZADO) {
                $servicio->estado = Servicios::ESTADO_PENDIENTE;
            }
            $mensage = 'Su cambio fue registrado con éxito!';
        }

        $servicio->nombre = $request->input('nombre');
        $servicio->slug = StringsHelper::generarSlug($request->input('nombre'));
        $servicio->descripcion = $request->input('descripcion');
        $servicio->telefonos = $request->input('telefonos');
        $servicio->whatsapp = $request->input('whatsapp');
        $servicio->facebook = $request->input('facebook');
        $servicio->direccion = $request->input('direccion');
        $servicio->localidad = $request->input('localidad');

        if ($request->hasFile('archivo')) {
            $destino = public_path(Servicios::RUTA_IMAGENES);
            if ($servicio->archivo) {
                unlink($destino.'/'.$servicio->archivo);
            }
            $archivo = $request->file('archivo');
            $nombreArchivo = time().'.'.$archivo->getClientOriginalExtension();
            $archivo->move($destino, $nombreArchivo);
            $servicio->archivo = $nombreArchivo;
        }

        $servicio->serviciosGruposId = $grupo->id;
        $servicio->usuariosId = $usuario->id;
        $servicio->save();
        $request->session()->flash('mensage', [
            'tipo' => 'success',
            'mensage' => $mensage
        ]);
        return redirect()->route('web.servicios.mis');
    }

    private function obtenerReglasValidacion($id = null)
    {
        $reglas = [
            'nombre' => 'required',
            'telefonos' => 'required',
            'localidad' => 'required',
            'serviciosGruposId' => 'required',
            'archivo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        if ($id) {
            $reglas['id'] = 'required|integer';
        }
        return $reglas;
    }

    public function borrar(Request $request, $id)
    {
        $servicio = Servicios::findOrFail($id);
        if ($servicio->usuariosId != AutenticadorHelper::obtenerDatos()->id) {
            return redirect()->route('web.index');
        }

        $servicio->comentarios()->forceDelete();
        $servicio->evaluaciones()->forceDelete();
        $servicio->forceDelete();
        $request->session()->flash('mensage', [
            'tipo' => 'success',
            'mensage' => 'Servicio borrado con éxito!'
        ]);
        return redirect()->route('web.servicios.mis');
    }
}
