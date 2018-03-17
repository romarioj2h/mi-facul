<?php
/**
 * Created by PhpStorm.
 * User: romario
 * Date: 17/02/18
 * Time: 18:40
 */

namespace App\Services\Firebase\Autenticacion;


use App\Services\Firebase\ServiceAccountFactory;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Factory;

class Firebase implements AutenticadorInterface
{

    public static function esValido($token)
    {
        $serviceAccount = ServiceAccountFactory::make();
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->asUser('preguntas-worker')
            ->create();

        try {
            $firebase->getAuth()->verifyIdToken($token);
            return true;
        } catch (InvalidToken $e) {
            return false;
        }
    }
}