<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    //
    public $timestamps = false;
    protected $table = 'municipio';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nombre_municipio',
        'id_departamento',
        'estado'
    ];
}
