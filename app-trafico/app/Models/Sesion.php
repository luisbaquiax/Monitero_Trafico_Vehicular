<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    //
    public $timestamps = false;
    protected $table = 'sesion';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'fecha', 'hora_inicio', 'hora_salida','id_usuario'];
}
