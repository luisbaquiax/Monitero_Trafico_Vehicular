<?php

namespace App\Http\Controllers;

use App\Models\ArchivoRegistro;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ArchivoRegistroController extends Controller
{
    //
    public function archivosPorUsuario($id_usuario)
    {
        $archivos = ArchivoRegistro::with(['registros'])->where('id_usuario', $id_usuario)->get();
        return view('supervisor/report-files')
            ->with('archivos', $archivos)
            ->with('monitor', Usuario::find($id_usuario));
    }

}
