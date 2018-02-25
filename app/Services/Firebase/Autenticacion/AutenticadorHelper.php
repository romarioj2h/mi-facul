<?php
/**
 * Created by PhpStorm.
 * User: romario
 * Date: 18/02/18
 * Time: 15:16
 */

namespace App\Services\Firebase\Autenticacion;


use Illuminate\Support\Facades\Session;
use stdClass;

class AutenticadorHelper
{
    public static function estaLogueado()
    {
        return Session::exists('email');
    }

    /**
     * Todo refactor retornar objecto usuario
     * @return bool|stdClass
     */
    public static function obtenerDatos()
    {
        if (self::estaLogueado()) {
            $datos = new stdClass();
            $datos->token = Session::get('token');
            $datos->email = Session::get('email');
            $datos->nombre = Session::get('nombre');
            $datos->foto = Session::get('foto');
            $datos->origen = Session::get('origen');
            $datos->usuarioId = Session::get('usuarioId');
            return $datos;
        }
        return false;
    }
}