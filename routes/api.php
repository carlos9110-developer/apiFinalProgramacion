<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'jwt']], function () {
    Route::get('traerPlatos', 'FoodController@index');
    Route::post('registrarPlato', 'FoodController@store');
    Route::get('traerPlato/{id}', 'FoodController@show');
    Route::put('actualizarPlato', 'FoodController@update');
    Route::delete('eliminarPlato/{id}', 'FoodController@destroy');
    Route::put('promocionarPlato', 'FoodController@promocionarPlato');
    Route::put('quitarPromocion', 'FoodController@quitarPromocion');
    Route::get('traerUsuarios', 'UserController@index');
    Route::post('registrarUsuario', 'UserController@store');
    Route::post('editarUsuario', 'UserController@update');
    Route::get('traerPedidos', 'PedidosController@index');
    Route::get('listarDetallePedido/{id}', 'PedidosController@listarDetalle');
    Route::put('marcarComoFacturado', 'PedidosController@marcarComoFacturado');
});


Route::group(['middleware' => ['cors']], function () {
    Route::get('traerPlatosPagina', 'FoodController@index');
// ruta para realizar el login de la base de datos
Route::get('login/{usuario}/{password}','UserController@login');
// ruta para registrar los usuarios en la base de datos
Route::post('registrarPedido','PedidosController@registrarPedido');
Route::get('listarPromociones', 'FoodController@listarPromociones');
});



