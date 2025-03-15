<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    //
    public $timestamps = false;
    protected $table = 'sensor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'tipo_sensor',
        'id_semaforo',
        'estado'
    ];
}
