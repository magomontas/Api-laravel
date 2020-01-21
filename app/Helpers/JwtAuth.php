<?php

namespace App\Helpers;

use Firebase\JWT\JWT;

class JwtAuth
{
    public $key;

    public function __construct()
    {
        $this->key = 'clave--secreta--0987654321';
    }

    public function sigup($email, $password, $getToken = null)
    {
        $user = User::where(
            array(
                'email' => $email,
                'password' => $password
            ))->first();
        $sigup = false;

        if (is_object($user)) {
            $sigup = true;
        }

        if ($sigup) {
            //Generamos el token de autenticacion
            $token = array(
                'sub' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'role' => $user->role,
                'iat' => time(),
                'exp' => time() + (7 * 24 * 60 * 60)
            );

            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, array('HS256'));


            if (is_null($getToken)) {
                return $jwt;
            } else {
                return $decoded;
            }
        } else {
            // Devolvemos un errror
            return array('status' => 'error', 'message' => 'El login ha fallado');
        }
    }

    /**
     * @return string
     */
    public function checkToken($jwt, $getIdentity = false)
    {
        $auth = false;

        try{
            $decoded = JWT::decode($jwt, $this->key, array('HS256'));
        }catch (\UnexpectedValueException $e){
            $auth = false;
        }catch (\DomainException $e){
            $auth = false;
        }

        if (isset($decoded) && is_object($decoded) && isset($decoded->sub)){
            $auth=true;
        }else{
            $auth = false;
        }

        if ($getIdentity){
            return $decoded;
        }

        return $auth;
    }

}
