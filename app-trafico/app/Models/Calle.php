<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calle extends Model
{
    //
    public $timestamps = false;
    protected $table = 'calle';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nombre_calle',
        'tipo',
        'id_municipio',
        'estado',
    ];

    public function municipio()
    {
        return $this->hasOne(Municipio::class, 'id', 'id_municipio');
    }
}
