<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table    = "foods";
    protected $fillable = [];// con esto quito todas las restricciones para asignación de datos en masa
    protected $guarded  = ['id']; // id
}
