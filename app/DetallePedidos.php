<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedidos extends Model
{
    protected $table    = "detalle_pedidos";
    protected $fillable = [];// con esto quito todas las restricciones para asignación de datos en masa
    protected $guarded  = ['id']; // id
}
