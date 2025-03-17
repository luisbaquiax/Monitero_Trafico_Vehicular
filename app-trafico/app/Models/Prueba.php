<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    //
    public $timestamps = false;
    protected $table = 'prueba';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'fecha',
        'hora',
        'estado',
        'id_usuario',
        'id_archivo_registro'
    ];

    public function tipo_archivo()
    {
        return $this->hasOne(ArchivoRegistro::class, 'id', 'id_archivo_registro');
    }
}
