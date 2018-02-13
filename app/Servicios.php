<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    const UPDATED_AT = 'actualizadoEn';
    const CREATED_AT = 'creadoEn';
    const TABLE = 'servicios';
    const ITEMS_POR_PAGINA = 10;

    protected $table = self::TABLE;

    public function grupos()
    {
        return $this->belongsTo('App\ServiciosGrupos', 'serviciosGruposId');
    }
}
