<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pedidos;

class PedidosController extends Controller
{
    public function registrarPedido(Request $request)
    {
        DB::beginTransaction();
        try {
            $id_pedido = Pedidos::create([
                'cedula'=>$request->cedula,
                'cliente'=>$request->cliente,
                'celular'=>$request->celular,
                'direccion'=>$request->direccion,
                'precio'=>$request->total
            ]);
            foreach ($request->detallePedido as $key => $value) {
                DB::insert('INSERT INTO detalle_pedidos (id_pedido,plato,cantidad)
                VALUES (:id_pedido,:plato,:cantidad)',
                ['id_pedido'=>$id_pedido->id,'plato'=>$value['plato'],'cantidad'=>$value['cantidad']]);
            }
            DB::commit();
            $data = array(
                'success'=> true,
                'msg'   => 'Pedido registrado correctamente'
            );
        } catch (\Exception $e) {
            $data = array(
                'success'=> false,
                'msg'    => 'Error, se presento un problema al registrar el pedido'
            );
            DB::rollback();
        }
        return $data;
    }

    //método donde se retornan todos los PEIDOS DE LA BASE DE DATOS
    public function index()
    {
        $pedidos = Pedidos::all();
        return response()->json(array(
            'pedidos'   => $pedidos,
            'status'    =>'success'
        ),200);
    }

    /** METODO DONDE SE LISTAN LOS DETALLES DE UN PEDIDO */
    public function listarDetalle($id){
        $detalle = DB::table('detalle_pedidos')->where('id_pedido', '=', $id)->get();
        return response()->json(array(
            'detalle'=> $detalle,
            'status'=>'success'
        ),200);
    }

    /** METODO DONDE SE MARCA UN PEDIDO COMO FACTURADO */
    public function marcarComoFacturado(Request $request)
    {
        if(DB::table('pedidos')->where('id', $request->id)->update(['estado' => 2])){
            $data = array(
                'success'=> true,
                'msg'   => 'Pedido facturado correctamente'
            );
        }else{
            $data = array(
                'success'=> true,
                'msg'   => 'Error, se presento un problema al facturar el pedido'
            );
        }
        return $data;
    }
}
