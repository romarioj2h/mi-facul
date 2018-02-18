<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    const UPDATED_AT = 'actualizadoEn';
    const CREATED_AT = 'creadoEn';
    const TABLE = 'usuarios';

    //
    public static function obtenerPorEmail($email)
    {
        $usuario = Usuarios::where('email', '=', $email)->get();
        if ($usuario->count() == 0) {
            return false;
        }
        return $usuario->first();
    }
}