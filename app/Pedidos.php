<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table    = "pedidos";
    protected $fillable = [];// con esto quito todas las restricciones para asignación de datos en masa
    protected $guarded  = ['id']; // id
}
