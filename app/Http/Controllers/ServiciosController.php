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

    public function obtenerServicios(Request $request, $id)
    {
        $grupo = ServiciosGrupos::findOrFail($id);
        $query = Servicios::where('serviciosGruposId', '=', $id)->where('estado', '=', Servicios::ESTADO_APROBADO);
        if ($request->has('order')) {
            $order = $request->get('order');
            if ($order == 'mejorEvaluado') {
                $query->orderBy('promedioEvaluaciones', 'desc');
            } elseif ($order == 'peorEvaluado') {
                $query->orderBy('promedioEvaluaciones', 'asc');
            }
        }
        return view('servicios.obtenerServicios', [
            'grupo' => $grupo,
            'servicios' => $query->get()
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
        $query = Servicios::where('estado', '=', Servicios::ESTADO_APROBADO)
            ->where(function ($query) use ($terminoDeBusqueda) {
                $query->where('nombre', 'like', '%'.$terminoDeBusqueda.'%')
                    ->orWhere('descripcion', 'like', '%'.$terminoDeBusqueda.'%');
            });
        if ($request->has('order')) {
            $order = $request->get('order');
            if ($order == 'mejorEvaluado') {
                $query->orderBy('promedioEvaluaciones', 'desc');
            } elseif ($order == 'peorEvaluado') {
                $query->orderBy('promedioEvaluaciones', 'asc');
            }
        }

        return view('servicios.busca', [
            'servicios' => $query->get(),
            'terminoDeBusqueda' => $terminoDeBusqueda
        ]);
    }
}
