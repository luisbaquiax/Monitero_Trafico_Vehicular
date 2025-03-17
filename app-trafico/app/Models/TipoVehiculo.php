<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    //
    public $timestamps = false;
    protected $table = 'tipo_vehiculo';
    protected $primaryKey = 'id';
    protected $fillable = ['id','tipo'];
}
