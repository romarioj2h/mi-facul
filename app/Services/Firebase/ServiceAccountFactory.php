<?php

namespace App\Services\Firebase;

use Kreait\Firebase\ServiceAccount;

/**
 * Created by PhpStorm.
 * User: romario
 * Date: 17/02/18
 * Time: 18:46
 */
class ServiceAccountFactory
{

    public static function make()
    {
        $serviceAccount = ServiceAccount::fromArray([
            'project_id' => Config::PROJECT_ID,
            'client_id' => Config::CLIENT_ID,
            'client_email' => Config::CLIENT_EMAIL,
            'private_key' => Config::PRIVATE_KEY,
        ]);

        return $serviceAccount;
    }
}