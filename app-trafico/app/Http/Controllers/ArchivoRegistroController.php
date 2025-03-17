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
        $archivos = self::listArchivosPorUsuario($id_usuario);
        return view('supervisor/report-files')
            ->with('archivos', $archivos)
            ->with('monitor', Usuario::find($id_usuario));
    }

    public function monitorArchivos()
    {
        return view('monitor/monitor-files')->with('archivos', self::listArchivosPorUsuario(session('user')->id));
    }

    public static function listArchivosPorUsuario($id_usuario)
    {
        return ArchivoRegistro::with(['registros'])->where('id_usuario', $id_usuario)->get();
    }

}
