<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TraficoController extends Controller
{
    //
    public function mostrarSimulacion($id_archivo, $id_interseccion)
    {
        $registros = DB::select("
        SELECT rv.velocidad, rv.estado_semaforo, t.tipo, o.nombre as direccion
        FROM registro_vehiculo rv
        INNER JOIN tipo_vehiculo t ON t.id = rv.id_tipo_vehiculo
        INNER JOIN sensor sen ON sen.id = rv.id_sensor
        INNER JOIN semaforo s ON s.id = sen.id_semaforo
        INNER JOIN trafico.orientacion o ON o.id = s.id_orientacion
        INNER JOIN interseccion i ON s.id_interseccion = i.id
        WHERE i.id = ? AND rv.id_registro_archivo = ?
        ORDER BY hora ASC;", [$id_interseccion, $id_archivo]);

        return view('monitor.simulacion', compact('registros'));
    }


}
