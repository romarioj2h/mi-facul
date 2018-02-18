<?php
/**
 * Created by PhpStorm.
 * User: romario
 * Date: 18/02/18
 * Time: 15:16
 */

namespace App\Services\Firebase\Autenticacion;


use Illuminate\Support\Facades\Session;

class AutenticadorHelper
{
    public static function estaLogueado()
    {
        return Session::exists('email');
    }

}