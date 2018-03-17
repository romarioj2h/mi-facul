<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    const UPDATED_AT = 'actualizadoEn';
    const CREATED_AT = 'creadoEn';
    const TABLE = 'servicios';
    const ITEMS_POR_PAGINA = 10;

    const ESTADO_PENDIENTE = 'PENDIENTE';
    const ESTADO_APROBADO = 'APROBADO';
    const ESTADO_RECHAZADO = 'RECHAZADO';

    const RUTA_IMAGENES = '/imagenes';

    protected $table = self::TABLE;

    public function grupos()
    {
        return $this->belongsTo('App\ServiciosGrupos', 'serviciosGruposId');
    }

    public function usuarios()
    {
        return $this->belongsTo('App\Usuarios', 'usuariosId');
    }

    public function comentarios()
    {
        return $this->hasMany('App\ServiciosComentarios', 'serviciosId')->orderByDesc(ServiciosComentarios::CREATED_AT);
    }

    public function evaluaciones()
    {
        return $this->hasMany('App\ServiciosEvaluaciones', 'serviciosId');
    }

    public function telefonos()
    {
        return explode(',', $this->telefonos);
    }
}
