<?php

namespace App\Http\Controllers;

use App\Models\ArchivoRegistro;
use App\Models\RegistroVehiculo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroVehiculoController extends Controller
{
    //
    public function cargarDatos()
    {

        $archivo = request()->file('archivo');
        $contenido = file_get_contents($archivo);

        // Decodificar el JSON
        $datos = json_decode($contenido, true);

        if (!$datos) {
            return back()->with('error', 'El archivo no tiene un formato válido.');
        }

        $usuario = new Usuario();
        $userSesion = session('user');
        $usuario->id = $userSesion->id;

        $archivoRegistro = ArchivoRegistro::create([
            'fecha' => $datos['fecha'],
            'hora_inicio' => $datos['hora_inicio'],
            'hora_finalizacion' => $datos['hora_finalizacion'],
            'id_usuario' => $usuario->id,
            'tipo' => $datos['tipo'],
        ]);


        foreach ($datos['registros'] as $registro) {
            try {
                RegistroVehiculo::create([
                    'id_tipo_vehiculo' => $registro['id_tipo_vehiculo'],
                    'velocidad' => $registro['velocidad'],
                    'hora' => $registro['hora'],
                    'estado_semaforo' => $registro['estado_semaforo'],
                    'id_registro_archivo' => $archivoRegistro->id,
                    'id_sensor' => $registro['id_sensor'],
                ]);
            }catch (\Exception $e){
                echo $e->getMessage();
            }

        }
        $registros = RegistroVehiculo::registrosPorInterseccion(request()->id_interseccion);

        return view('monitor/monitor-interaccion')
            ->with('msg-success', 'Registros guardados correctamente.')
            ->with('registros', $registros)
            ->with('id_interseccion', request()->id_interseccion);
        //return view('monitor/monitor-interaccion')->with('success', 'Registro registrado correctamente.');
    }
}
