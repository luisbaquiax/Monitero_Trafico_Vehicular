<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    //
    public $timestamps = false;
    protected $table = 'zona';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'numero_zona'];
}
