<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    public $timestamps = false;
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'password',
        'nombre_usuario',
        'nombres',
        'apellidos',
        'correo',
        'telefono',
        'fecha_creacion',
        'estado',
        'id_rol'
    ];

}
