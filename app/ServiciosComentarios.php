<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiciosComentarios extends Model
{
    const UPDATED_AT = 'actualizadoEn';
    const CREATED_AT = 'creadoEn';
    const TABLE = 'serviciosComentarios';

    protected $table = self::TABLE;

    public function servicio()
    {
        return $this->belongsTo('App\Servicios', 'serviciosId');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Usuarios', 'usuariosId');
    }
}
