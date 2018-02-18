<?php
/**
 * Created by PhpStorm.
 * User: romario
 * Date: 17/02/18
 * Time: 18:44
 */

namespace App\Services\Firebase\Autenticacion;


interface AutenticadorInterface
{

    public static function esValido($token);
}