<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroVehiculo extends Model
{
    //
    public $timestamps = false;
    protected $table = 'registro_vehiculo';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_tipo_vehiculo',
        'velocidad',
        'hora',
        'estado_semaforo',
        'id_registro_archivo',
        'id_sensor'
    ];

    public function archivo()
    {
        return $this->belongsTo(ArchivoRegistro::class, 'id_registro_archivo');
    }

    public function tipo_vehiculo()
    {
        //return $this->hasOne(TipoVehiculo::class, 'id', 'id_tipo_vehiculo');
        return $this->belongsTo(TipoVehiculo::class, 'id_tipo_vehiculo');
    }

    public function sensor()
    {
        return $this->hasOne(Sensor::class, 'id', 'id_sensor');
        //return $this->belongsTo(Sensor::class, 'id_sensor');
    }

    public static function registrosPorInterseccion()
    {
        return self::with([
            'sensor.semaforo.interseccion'
        ])->whereHas('sensor.semaforo.interseccion', function ($query) {
            $query->where('id', request()->id_interseccion);
        })->get();
    }

}
