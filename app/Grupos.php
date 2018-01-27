<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    const UPDATED_AT = 'actualizadoEn';
    const CREATED_AT = 'creadoEn';
    const TABLE = 'grupos';

    protected $table = self::TABLE;

    public function preguntas()
    {
        return $this->hasMany('App\Preguntas', 'gruposId');
    }
}
