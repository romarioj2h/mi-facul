<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    const UPDATED_AT = 'actualizadoEn';
    const CREATED_AT = 'creadoEn';
    const TABLE = 'preguntas';
    const ITEMS_POR_PAGINA = 10;

    protected $table = self::TABLE;

    public function grupos()
    {
        return $this->belongsTo('App\Grupos', 'gruposId');
    }

    public function respuestas()
    {
        $respuestas = [];
        if ($this->respuesta1) {
            $respuestas[1] = $this->respuesta1;
        }
        if ($this->respuesta2) {
            $respuestas[2] = $this->respuesta2;
        }
        if ($this->respuesta3) {
            $respuestas[3] = $this->respuesta3;
        }
        if ($this->respuesta4) {
            $respuestas[4] = $this->respuesta4;
        }

        return $respuestas;
    }
}
