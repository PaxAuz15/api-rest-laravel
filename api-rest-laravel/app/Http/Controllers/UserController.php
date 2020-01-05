<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function test(Request $request){ //el objeto request permite utilizar metodos http 
        return "Test action from UserController";
    }

    public function register(Request $request){
        /*
        //PROBAR CON UN FORMULARIO EN POSTMAN/BODY
        $name = $request->input('name');
        $surname = $request->input('surname');
        return "Register action to user: $name $surname";
        */

        //RECOGER LOS DATOS DEL USUARIO POR POST 
        $json = $request->input('json', null);
        
        /* PRUEBA DE FUNCIONAMIENTO
        var_dump($json);
        die();
        */
        
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        
        //var_dump($params); die();

        if(!empty($params) && !empty($params_array)){
            //LIMPIAR DATOS
            //Sirve para aceptar espacios erroneos al escribir. Utiliza el TRIM de relleno
            $params_array = array_map('trim', $params_array);

            //VALIDAR LOS DATOS
            $validate = \Validator::make($params_array, [
                'name' => 'required|alpha',
                'surname' => 'required|alpha',
                'email' => 'required|email|unique:users', //unique:users VALIDA EN LA TABLA DE USUARIOS SI EXISTE O NO 
                'password' => 'required'
            ]);

            if($validate->fails()){

                $data = array(
                    'status'  => 'error',
                    'code'    => 404,
                    'message' => 'El usuario no se ha creado',
                    'errors' => $validate->errors()
                );
        
                
            }else{//VALIDACION CORRECTA

                //CIFRAR PASSWORD 
                $pwd = password_hash($params->password, PASSWORD_BCRYPT, ['cost'=>4]); //cost indica la cantidad de cifrados aplicados


                //COMPROBAR SI EL USUARIO EXISTE (DUPLICADO) --SE ENCUENTRA EN LA SECCION DE VALIDACION DE DATOS unique:users 

                //CREAR EL USUARIO
                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role = 'ROLE_USER'; 
                

                //GUARDAR USUARIO
                $user->save();
                

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'El usuario se ha creado correctamente',
                    'user' => $user //devuelve info del usuario
                );
            }
        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos'
            );
        }

        
        return response()->json($data, $data['code']);
    }

    public function login(Request $request){
        return "Login action to user";
    }
}
