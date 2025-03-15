<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    public $timestamps = false;
    protected $table = 'departamento';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nombre_departamento',
        'estado',
    ];
}
