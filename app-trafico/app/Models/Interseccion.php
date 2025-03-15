<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interseccion extends Model
{
    //
    public $timestamps = false;
    protected $table = 'interseccion';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nombre',
        'id_calle',
        'id_avenida',
        'zona',
        'estado',
    ];

    public function calle()
    {
        return $this->hasOne(Calle::class, 'id', 'id_calle');
    }

    public function avenida()
    {
        return $this->hasOne(Calle::class, 'id', 'id_avenida');
    }

}
