<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Food;


class FoodController extends Controller
{
    //método donde se retornan todos los platos de la base de datos
    public function index(Request $request)
    {
        $foods = Food::all();
        return response()->json(array(
            'platos'=> $foods,
            'status'=>'success'
        ),200);
    }

    //método donde se realiza el registro de los platos
    public function store(Request $request)
    {
        //return $request;
        $plato     =  $request->nombre;
        $precio    =  $request->precio;
        
        
        if( !is_null($plato)  && !is_null($precio)  ){
            // vamos a crear un plato
            $foods = new Food();
            $foods->plato       =   $plato;
            $foods->precio      =   $precio;

            if($plato=="Chicharron"){
                $foods->img         =   "assets/img/chicharron.jpg";
            }else if($plato=="Perro Caliente"){
                $foods->img         =   "assets/img/perro.jpg";
            }

            if($foods->save()){
                $data = array(
                    'success'=> true,
                    'msg'   => 'Plato registrado correctamente'
                );
            }else{
                $data = array(
                    'success'=> false,
                    'msg'   => 'Error, no fue posible registrar el plato'
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

    // metodo para traer el detalle de un plato
    public function show($id){
        $food = Food::find($id);
        return response()->json(array('plato'=>$food,'status'=>'success'),200);
    }

    // metodo donde se actualiza la información de un registro
    public function update(Request $request)
    {

        $plato     =  $request->nombre;// is_null función propia de php
        $precio    =  $request->precio;
        $id        =  $request->id;

        if( !is_null($plato)  && !is_null($precio)  ){
            // vamos a crear un plato
            $foods = Food::find($id);
            $foods->plato  = $plato;
            $foods->precio = $precio;

            if($foods->save()){
                $data = array(
                    'success'=> true,
                    'msg'   => 'Información plato editado correctamente'
                );
            }else{
                $data = array(
                    'success'=> false,
                    'msg'   => 'Error, no fue posible editar el plato'
                );
            }
        } else {
            $data = array(
                'success'=> false,
                'msg'   => 'Eror, faltaron campos por llenar'
            );
        }

        return $data;
    }

    public function destroy($id, Request $request ){
        $food = Food::find($id);
        if($food->delete()){
            $data = array(
                'success'=> true,
                'msg'   => 'Plato eliminado correctamente'
            );
        }else{
            $data = array(
                'success'=> false,
                'msg'   => 'Error, no fue posible eliminar plato'
            );
        }
        return $data;
    }

    /** METODO DONDE SE PROMOCIONA UN DETERMINADO PLATO */
    public function promocionarPlato(Request $request)
    {
        if(Food::where('id', $request->id)->update(['promocion' => '1', 'precio_promocion' => $request->valor_promocion])){
            $data = array(
                'success'=> true,
                'msg'   => 'Plato promocionado correctamente'
            );
        }else{
            $data = array(
                'success'=> false,
                'msg'   => 'Error no fue posible promocionar el plato'
            );
        }
        return $data;
    }

     /** METODO DONDE SE QUITA LA PROMOCIÓN DE UN PLATO */
     public function quitarPromocion(Request $request)
     {
         if(Food::where('id', $request->id)->update(['promocion' => '0'])){
             $data = array(
                 'success'=> true,
                 'msg'   => 'Se ha quitado la promoción del plato correctamente'
             );
         }else{
             $data = array(
                 'success'=> false,
                 'msg'   => 'Error no fue posible quitar la promoción de el plato'
             );
         }
         return $data;
     }

     //método donde se retornan todos los platos de la base de datos
    public function listarPromociones()
    {
        $foods = DB::table('foods')->where('promocion', '=', '1')->get();
        return response()->json(array(
            'promociones'=> $foods,
            'status'=>'success'
        ),200);
    }
}
