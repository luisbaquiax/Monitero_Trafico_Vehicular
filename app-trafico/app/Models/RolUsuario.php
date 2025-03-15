<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    //
    public $timestamps = false;
    protected $table = 'rol';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nombre_rol'
    ];
}
