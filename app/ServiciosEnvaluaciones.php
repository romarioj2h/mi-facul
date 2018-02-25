<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiciosEnvaluaciones extends Model
{
    const UPDATED_AT = 'actualizadoEn';
    const CREATED_AT = 'creadoEn';
    const TABLE = 'serviciosEvaluaciones';

    protected $table = self::TABLE;

    public function servicio()
    {
        return $this->belongsTo('App\Servicios', 'serviciosId');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Usuarios', 'usuariosId');
    }

    public static function obtener($servicioId, $usuarioId) {
        $datos = self::where('serviciosId', '=', $servicioId)
            ->where('usuariosId', '=', $usuarioId)
            ->get();
        if ($datos->count()) {
            return $datos->first();
        }
        return false;
    }
}
