<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Helpers\JwtAuth;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    // método para registrar los usuarios
    public function register(Request $request)
    {
        echo "Acción registro"; die();
    }

    public function login($usuario,$password)
    {
        $usuario    =   $usuario;
        $password   =   $password;

        if(!is_null($usuario) && !is_null($password) )
        {
            $jwt = new JwtAuth();
            return new JsonResponse($jwt->login($usuario,$password));
        }
    }

    //método donde se retornan todos los platos de la base de datos
    public function index()
    {
        $users = User::all();
        return response()->json(array(
            'usuarios'=> $users,
            'status'=>'success'
        ),200);
    }

    //método donde se registran los usuarios
    public function store(Request $request)
    {
       //return $request;
       $user     =  $request->cedula;
       $name     =  $request->nombre;
       
       
       if( !is_null($user)  && !is_null($name)  ){
           // vamos a crear un plato
           $users            = new User();
           $users->user      =   $user;
           $users->name      =   $name;
           $users->role      =   "Administrador"; 
           $users->password  =   hash("SHA256",$user);
           
           if($users->save()){
               $data = array(
                   'success'=> true,
                   'msg'   => 'Usuario registrado correctamente, el usuario y la contraseña para ingresar a la aplicación es la cédula registrada'
               );
           }else{
               $data = array(
                   'success'=> false,
                   'msg'   => 'Error, no fue posible registrar el usuario'
               );
           }

       } else {
           $data = array(
               'success'=> false,
               'msg'   => 'Error, algunos campos estan vacios'
           );
       }
       return $data;
    }

     //método donde se editan los usuarios
    public function update(Request $request)
    {
        //return $request;
        $user     =  $request->cedula;
        $name     =  $request->nombre;
        $id       =  $request->id;

        if( !is_null($user)  && !is_null($name)  ){
            // vamos a editar un registro
            $users            = User::find($id);
            $users->user      = $user;
            $users->name      = $name;
            $users->role      = "Administrador"; 
            $users->password  = hash("SHA256",$user);
            
            if($users->save()){
                $data = array(
                    'success'=> true,
                    'msg'   => 'Información usuario editada correctamente, el usuario y la contraseña para ingresar a la aplicación es la cédula registrada'
                );
            }else{
                $data = array(
                    'success'=> false,
                    'msg'   => 'Error, no fue posible registrar el usuario'
                );
            }
 
        } else {
            $data = array(
                'success'=> false,
                'msg'   => 'Error, algunos campos estan vacios'
            );
        }
        return $data;
    }


    
}
