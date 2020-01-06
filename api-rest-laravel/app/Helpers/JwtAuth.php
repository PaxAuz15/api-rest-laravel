<?php

//Se define el nombre del paquete donde esta esta clase
namespace App\Helpers;

//Utilizar librerias
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB; //Permite realizar consultas a la db 
use App\User; //Utilizar el modelo 

class JwtAuth{
    
    public $key;

    public function __construct(){
        $this->key = 'esto_es_una_clave_super_secreta-99887766';
    }

    public function signup($email, $password, $getToken = null){

        //BUSCAR SI EXISTE EL USUARIO CON SUS CREDENCIALES
        $user = User::where([
            'email' => $email,
            'password' => $password
        ]) ->first();


        //COMPROBAR SI SON CORRECTAS
        $signup = false;
        if(is_object($user)){
            $signup = true;
        }

        //GENERAR EL TOKEN CON LOS DATOS DEL USUARIO IDENTIFICADO
        if($signup){

            $token = array(
                'sub' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'surname' => $user->username,
                'iat' => time(),
                'exp' => time() + (7*24*60*60)
            );

            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);

            //DEVOLVER LOS DATOS DECODIFICADOS O EL TOKEN, EN FUNCION DE UN PARAMETRO
            if(is_null($getToken)){
                $data = $jwt;

            }else{
                $data = $decoded;
            }

        }else{
            $data = array(
                'status' => 'error',
                'message' => 'Login incorrecto'
            );
        }

        return $data;

        

        return 'Metodo de la clase JWTAUTH';
    }
    
}