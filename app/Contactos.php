<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactos extends Model
{
    const UPDATED_AT = 'actualizadoEn';
    const CREATED_AT = 'creadoEn';
    const TABLE = 'contactos';
    const ITEMS_POR_PAGINA = 10;

    const NUEVA = 'nueva';
    const LEIDA = 'leida';

    protected $table = self::TABLE;
}
