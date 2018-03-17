<?php
/**
 * Created by PhpStorm.
 * User: romario
 * Date: 18/02/18
 * Time: 11:19
 */

namespace App\Services\Firebase\Autenticacion;


class AutenticadorFactory
{
    /**
     * @param string $origen
     * @return AutenticadorInterface
     */
    public static function obtenerPorOrigen($origen)
    {
        if ($origen == 'google') {
            return Firebase::class;
        }
        return false;
    }
}