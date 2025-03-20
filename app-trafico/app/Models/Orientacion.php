<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orientacion extends Model
{
    //
    public $timestamps = false;
    protected $table = 'orientacion';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre'];

    public function semaforo()
    {
        return $this->hasMany(Semaforo::class, 'orientacion_id', 'id');
    }
}
