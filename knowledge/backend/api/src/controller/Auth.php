<?php

use \Firebase\JWT\JWT;

class Auth
{
    const SECRET = 'DFSOM23890R90NIFWE0JR234';
    const DURATION = 120;

    public static function generateToken($email) {
        $payload = array(
            "email" => $email,
            "exp" => time() + Auth::DURATION,
            "iat" => time()
        );
        return JWT::encode($payload, Auth::SECRET);
    }

    public static function validateToken($token)
    {
        try{
            $decoded = JWT::decode($token, Auth::SECRET, array('HS256'));
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }

}
