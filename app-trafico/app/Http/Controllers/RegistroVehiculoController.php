<?php

namespace App\Http\Controllers;

use App\Models\ArchivoRegistro;
use App\Models\Interseccion;
use App\Models\RegistroVehiculo;
use App\Models\Sensor;
use App\Models\TipoVehiculo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroVehiculoController extends Controller
{
    //
    public function cargarDatos()
    {
        try {
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

            $sensores = DB::table('sensor')
                ->join('semaforo', 'semaforo.id', '=', 'sensor.id_semaforo')
                ->where('semaforo.id_interseccion', request('id_interseccion'))
                ->pluck('sensor.id')
                ->toArray();

            foreach ($datos['registros'] as $registro) {
                $indiceSensor = array_rand($sensores);
                $sensorAleatorio = $sensores[$indiceSensor];
                try {
                    RegistroVehiculo::create([
                        'id_tipo_vehiculo' => $registro['id_tipo_vehiculo'],
                        'velocidad' => $registro['velocidad'],
                        'hora' => $registro['hora'],
                        'estado_semaforo' => $registro['estado_semaforo'],
                        'id_registro_archivo' => $archivoRegistro->id,
                        'id_sensor' => $sensorAleatorio,
                    ]);
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }

            }
            $registros = $this->registrosPorInterseccion($archivoRegistro->id, request('id_interseccion'));
            return view('monitor/flujo-vehicular-generado')
                ->with('msg-success', 'Registros guardados correctamente.')
                ->with('registros', $registros)
                ->with('id_interseccion', request()->id_interseccion);
        } catch (\Exception $e) {
            return back()->with('msg-danger', 'Hubo un error al intentar cargar los registros.');
        }
    }

    public function cargarRegistrosAleatorios()
    {
        try {
            $json = '[
                    {"hora_inicio": "7:00", "hora_final": "8:00"},
                    {"hora_inicio": "8:00", "hora_final": "9:00"},
                    {"hora_inicio": "9:00", "hora_final": "10:00"},
                    {"hora_inicio": "10:00", "hora_final": "11:00"},
                    {"hora_inicio": "11:00", "hora_final": "12:00"},
                    {"hora_inicio": "12:00", "hora_final": "13:00"},
                    {"hora_inicio": "13:00", "hora_final": "14:00"},
                    {"hora_inicio": "14:00", "hora_final": "15:00"},
                    {"hora_inicio": "15:00", "hora_final": "16:00"},
                    {"hora_inicio": "16:00", "hora_final": "17:00"},
                    {"hora_inicio": "17:00", "hora_final": "18:00"}
                ]';

            $horas = json_decode($json, true);

            $indiceAleatorio = array_rand($horas);

            $horaAleatoria = $horas[$indiceAleatorio];

            $archivoRegistro = new ArchivoRegistro();
            $archivoRegistro->fecha = UsuarioController::currentDate();
            $archivoRegistro->hora_inicio = $horaAleatoria['hora_inicio'];
            $archivoRegistro->hora_finalizacion = $horaAleatoria['hora_final'];
            $archivoRegistro->id_usuario = session('user')->id;
            $archivoRegistro->tipo = 'ALEATORIO';
            $archivoRegistro->save();


            $sensores = DB::table('sensor')
                ->join('semaforo', 'semaforo.id', '=', 'sensor.id_semaforo')
                ->where('semaforo.id_interseccion', request('id_interseccion'))
                ->pluck('sensor.id')
                ->toArray();


            for ($i = 0; $i < 100; $i++) {

                $indiceSensor = array_rand($sensores);
                $sensorAleatorio = $sensores[$indiceSensor];

                $tipoVehiculos = TipoVehiculo::all()->toArray();
                $indiceVehiculo = array_rand($tipoVehiculos);
                $vehiculoAleatorio = $tipoVehiculos[$indiceVehiculo];

                $registroVehiculo = new RegistroVehiculo();
                $registroVehiculo->id_tipo_vehiculo = $vehiculoAleatorio['id'];
                $registroVehiculo->velocidad = rand(10, 100) + (rand(0, 99) / 100);
                $registroVehiculo->hora = self::horaAleatoria($horaAleatoria['hora_inicio'], $horaAleatoria['hora_final']);
                $registroVehiculo->estado_semaforo = (rand(0, 1) == 0) ? 'AMARILLO' : 'VERDE';
                $registroVehiculo->id_registro_archivo = $archivoRegistro->id;
                $registroVehiculo->id_sensor = $sensorAleatorio;
                $registroVehiculo->save();
            }

            $registros = $this->registrosPorInterseccion($archivoRegistro->id, request('id_interseccion'));
            return view('monitor/flujo-vehicular-generado')
                ->with('msg-success', 'Registros guardados correctamente.')
                ->with('registros', $registros)
                ->with('id_interseccion', request()->id_interseccion);

        } catch (\Exception $e) {
            return back()->with('msg-danger', 'Hubo un error al generar datos');
        }
    }

    public function registrosPorInterseccion($id_archivo, $id_interseccion)
    {
        return RegistroVehiculo::where('id_registro_archivo', $id_archivo)
            ->whereHas('sensor.semaforo.interseccion', function ($query) use ($id_interseccion) {
                $query->where('id', $id_interseccion);
            })
            ->with([
                'sensor.semaforo.orientacion',
                'sensor.semaforo.interseccion'
            ])
            ->orderBy('hora','asc')
            ->get();
    }

    public static function horaAleatoria($horaInicio, $horaFinal): string
    {
        $inicioSegundos = strtotime($horaInicio);
        $finalSegundos = strtotime($horaFinal);

        $horaAleatoria = rand($inicioSegundos, $finalSegundos);

        return date('H:i:s', $horaAleatoria);
    }
}
