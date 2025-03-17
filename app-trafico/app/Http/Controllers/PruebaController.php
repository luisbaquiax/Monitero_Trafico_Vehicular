<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    //
    public function pruebasPorUsuario($id_usuario)
    {
        return view('supervisor/report-pruebas')
            ->with('pruebas', Prueba::where('id_usuario', $id_usuario)->get())
            ->with('monitor', Usuario::find($id_usuario));
    }
}
