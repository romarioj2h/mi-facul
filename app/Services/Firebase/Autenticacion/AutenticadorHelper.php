<?php
/**
 * Created by PhpStorm.
 * User: romario
 * Date: 18/02/18
 * Time: 15:16
 */

namespace App\Services\Firebase\Autenticacion;


use App\Usuarios;
use Illuminate\Support\Facades\Session;
use stdClass;

class AutenticadorHelper
{
    public static function estaLogueado()
    {
        return Session::exists('email');
    }

    /**
     * @return bool|stdClass
     */
    public static function obtenerDatos()
    {
        if (self::estaLogueado()) {
            $usuarioId = Session::get('usuarioId');
            return Usuarios::findOrFail($usuarioId);
        }
        return false;
    }
}