<?php

namespace App\Http\Controllers;

use App\Models\Sesion;
use App\Models\Usuario;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    //

    public function sessionesPorUsuario($id_usuario)
    {
        return view('supervisor/report-session')
            ->with('sesiones', Sesion::where('id_usuario', $id_usuario)->get())
            ->with('monitor', Usuario::find($id_usuario));
    }
}
