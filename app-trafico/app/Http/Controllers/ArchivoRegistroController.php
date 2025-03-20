<?php

namespace App\Http\Controllers;

use App\Models\ArchivoRegistro;
use App\Models\Interseccion;
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

    public function verResumenRegistros($id_interseccion, $id_archivo)
    {
        $interseccion = Interseccion::find($id_interseccion);
        $archivo = ArchivoRegistro::find($id_archivo);

        return view('monitor/resumen-registros');
    }

    public static function listArchivosPorUsuario($id_usuario)
    {
        return ArchivoRegistro::with(['registros'])->where('id_usuario', $id_usuario)->get();
    }

    public function archivosPorInterseccion()
    {
        $id_interseccion = request()->id_interseccion;
        //echo json_encode(self::listArchivosPorInterseccion($id_interseccion));
        return view('monitor/archivos-interseccion')
            ->with('archivos', self::listArchivosPorInterseccion($id_interseccion))
            ->with('id_interseccion', $id_interseccion)
            ->with('interseccion', Interseccion::find($id_interseccion));
    }

    public function listArchivosPorInterseccion($id_interseccion)
    {
        return ArchivoRegistro::whereHas('registros.sensor.semaforo.interseccion',
            function ($query) use ($id_interseccion) {
                $query->where('interseccion.id', $id_interseccion);
            })
            ->with(['registros.sensor.semaforo.interseccion'])
            ->get(['id', 'fecha', 'hora_inicio', 'hora_finalizacion', 'id_usuario', 'tipo']);
    }

}
