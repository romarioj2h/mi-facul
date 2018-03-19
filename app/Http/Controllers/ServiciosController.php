<?php

namespace App\Http\Controllers;

use App\Services\Firebase\Autenticacion\AutenticadorHelper;
use App\Servicios;
use App\ServiciosGrupos;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function obtenerGrupos()
    {
        return view('servicios.obtenerGrupos', [
            'grupos' => ServiciosGrupos::all()
        ]);
    }

    public function obtenerServicios($id)
    {
        $grupo = ServiciosGrupos::findOrFail($id);
        return view('servicios.obtenerServicios', [
            'grupo' => $grupo,
            'servicios' => $grupo->servicios->where('estado', '=', Servicios::ESTADO_APROBADO)
        ]);
    }

    public function mis()
    {
        return view('servicios.mis', [
            'servicios' => AutenticadorHelper::obtenerDatos()->servicios
        ]);
    }

    public function buscar(Request $request)
    {
        $terminoDeBusqueda = $request->get('q') ?? '';
        $servicios = Servicios::where('estado', '=', Servicios::ESTADO_APROBADO)
            ->where(function ($query) use ($terminoDeBusqueda) {
                $query->where('nombre', 'like', '%'.$terminoDeBusqueda.'%')
                    ->orWhere('descripcion', 'like', '%'.$terminoDeBusqueda.'%');
            })
            ->get();

        return view('servicios.busca', [
            'servicios' => $servicios,
            'terminoDeBusqueda' => $terminoDeBusqueda
        ]);
    }
}
