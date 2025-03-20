<?php

namespace App\Http\Controllers;

use App\Models\ArchivoRegistro;
use App\Models\Interseccion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

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

    public function verResumenRegistros($id_archivo, $id_interseccion)
    {
        $interseccion = Interseccion::find($id_interseccion);
        $archivo = ArchivoRegistro::find($id_archivo);
        $cantidadPorSemaforo = $this->cantidadRegistrosPorSensorSemaforo($id_interseccion, $id_archivo);
        $cantidadPorSemaforVehiculo = $this->cantidadRegistrosPorSemaforoYVehiculo($id_interseccion, $id_archivo);
        $velocidadMedia = $this->velocidadMedia($id_interseccion, $id_archivo);
        $totalVehiculos = $this->totalVehiculos($id_interseccion, $id_archivo);
        return view('monitor/resumen-registros')
            ->with('interseccion', $interseccion)
            ->with('archivo', $archivo)
            ->with('cantidadPorSemaforo', $cantidadPorSemaforo)
            ->with('cantidadPorSemaforVehiculo', $cantidadPorSemaforVehiculo)
            ->with('velocidadMedia', $velocidadMedia)
            ->with('totalVehiculos', $totalVehiculos);
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

    public static function cantidadRegistrosPorSensorSemaforo($id_interseccion, $id_archivo)
    {
        $query = "
                SELECT count(*) as cantidad, s.id as id_semaforo, o.nombre as orientacion, ROUND(AVG(velocidad), 2) as velocidad_media
                FROM registro_vehiculo rv
                INNER JOIN sensor sen ON sen.id = rv.id_sensor
                INNER JOIN semaforo s ON s.id = sen.id_semaforo
                INNER JOIN trafico.orientacion o ON o.id = s.id_orientacion
                INNER JOIN interseccion i ON s.id_interseccion = i.id
                WHERE i.id = :id_interseccion
                AND rv.id_registro_archivo = :id_archivo
                GROUP BY sen.id";
        return DB::select($query, [
            'id_interseccion' => $id_interseccion,
            'id_archivo' => $id_archivo
        ]);
    }

    public static function cantidadRegistrosPorSemaforoYVehiculo($id_interseccion, $id_archivo)
    {
        $query = "
                select count(*) as cantidad, s.id as id_semaforo, o.nombre as orientacion, t.tipo as tipo_vehiculo
                FROM registro_vehiculo rv
                INNER JOIN tipo_vehiculo t ON t.id = rv.id_tipo_vehiculo
                INNER JOIN sensor sen ON sen.id = rv.id_sensor
                INNER JOIN semaforo s ON s.id = sen.id_semaforo
                INNER JOIN trafico.orientacion o ON o.id = s.id_orientacion
                INNER JOIN interseccion i ON s.id_interseccion = i.id
                WHERE i.id = :id_interseccion
                AND rv.id_registro_archivo = :id_archivo
                GROUP BY sen.id, t.tipo";
        return DB::select($query, [
            'id_interseccion' => $id_interseccion,
            'id_archivo' => $id_archivo
        ]);
    }

    public static function velocidadMedia($id_interseccion, $id_archivo)
    {
        $query = "
        SELECT ROUND(AVG(velocidad), 2) as velocidad_media
        FROM registro_vehiculo rv
        INNER JOIN sensor sen ON sen.id = rv.id_sensor
        INNER JOIN semaforo s ON s.id = sen.id_semaforo
        INNER JOIN trafico.orientacion o ON o.id = s.id_orientacion
        INNER JOIN interseccion i ON s.id_interseccion = i.id
        WHERE i.id = :id_interseccion
        AND rv.id_registro_archivo = :id_archivo;
        ";
        return DB::select($query, [
            'id_interseccion' => $id_interseccion,
            'id_archivo' => $id_archivo
        ]);
    }

    public static function totalVehiculos($id_interseccion, $id_archivo)
    {
        $query = "
            SELECT count(*) as cantidad_vehiculos
            FROM registro_vehiculo rv
            INNER JOIN sensor sen ON sen.id = rv.id_sensor
            INNER JOIN semaforo s ON s.id = sen.id_semaforo
            INNER JOIN trafico.orientacion o ON o.id = s.id_orientacion
            INNER JOIN interseccion i ON s.id_interseccion = i.id
            WHERE i.id = :id_interseccion
            AND rv.id_registro_archivo = :id_archivo;
        ";
        return DB::select($query, [
            'id_interseccion' => $id_interseccion,
            'id_archivo' => $id_archivo
        ]);
    }

}
