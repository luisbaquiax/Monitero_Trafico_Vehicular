<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchivoRegistro extends Model
{
    //
    public $timestamps = false;
    protected $table = 'archivo_registro';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'fecha',
        'hora_inicio',
        'hora_finalizacion',
        'tipo',
        'id_usuario'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function registros()
    {
        return $this->hasMany(RegistroVehiculo::class, 'id_registro_archivo');
    }

    public function sensor()
    {
        return $this->hasManyThrough(Sensor::class, RegistroVehiculo::class, 'id_registro_archivo', 'id', 'id', 'id_sensor');
    }

    // Relación indirecta: Obtener semáforos a través de sensores
    public function semaforo()
    {
        return $this->hasManyThrough(Semaforo::class, Sensor::class, 'id', 'id', 'id', 'id_semaforo');
    }

    // Relación indirecta: Obtener intersecciones a través de semáforos
    public function interseccion()
    {
        return $this->hasManyThrough(Interseccion::class, Semaforo::class, 'id', 'id', 'id', 'id_interseccion');
    }

    /**
     * Cada archivo de registro es un paquete de registros
     */
    public function paquetesDeRegistros($id_interseccion){
            return view('monitor/monitor-interaccion')
                ->with('archivosRegistros', ArchivoRegistro::where('id_interseccion', $id_interseccion)->get());
    }
}
