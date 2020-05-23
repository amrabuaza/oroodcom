<?php

namespace backend\modules\models;

use backend\modules\models\UserModels\User;

class ApiHelper
{
    public static function getAccessTokenFromHeaders($request)
    {
        $authorization = $request->headers['authorization'];
        $authorization = explode(" ", $authorization);
        return $authorization[1];
    }

    public static function getUserFromRequest($request)
    {
        return User::findOne(["access_token" => ApiHelper::getAccessTokenFromHeaders($request)]);
    }

    public static function getUserFromToken($token)
    {
        return User::findOne(["access_token" => $token]);
    }

    public static function createUserProfileDirectoryOfCurrentMonthIfNotExists($currentDate)
    {
        if (!file_exists("uploads/user-pictures/" . $currentDate)) {
            mkdir("uploads/user-pictures/" . $currentDate);
        }
    }

    public static function guid()
    {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

}