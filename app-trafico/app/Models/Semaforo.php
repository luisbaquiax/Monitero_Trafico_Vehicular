<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semaforo extends Model
{
    //
    public $timestamps = false;
    protected $table = 'semaforo';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'tiempo_verde',
        'tiempo_amarillo',
        'tiempo_rojo',
        'estado',
        'id_interseccion'
    ];

    public function interseccion()
    {
        return $this->hasOne(Interseccion::class, 'id', 'id_interseccion');
    }
}
