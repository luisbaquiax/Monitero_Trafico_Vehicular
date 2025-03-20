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
        'id_interseccion',
        'id_orientacion'
    ];

    public function orientacion()
    {
        return $this->belongsTo(Orientacion::class, 'id_orientacion');
    }

    public function interseccion()
    {
        return $this->belongsTo(Interseccion::class, 'id_interseccion');
    }
}
