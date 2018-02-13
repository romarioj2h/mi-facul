<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiciosGrupos extends Model
{
    const UPDATED_AT = 'actualizadoEn';
    const CREATED_AT = 'creadoEn';
    const TABLE = 'serviciosGrupos';
    const ITEMS_POR_PAGINA = 10;

    protected $table = self::TABLE;

    public function servicios()
    {
        return $this->hasMany('App\Servicios', 'serviciosGruposId');
    }
}
