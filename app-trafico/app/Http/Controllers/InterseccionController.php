<?php

namespace App\Http\Controllers;

use App\Models\ArchivoRegistro;
use App\Models\Calle;
use App\Models\Interseccion;
use App\Models\RegistroVehiculo;
use App\Models\Semaforo;
use App\Models\Sensor;
use App\Models\Zona;
use Illuminate\Http\Request;

class InterseccionController extends Controller
{
    //
    public function index()
    {
        $intersecciones = Interseccion::with(['calle', 'avenida'])->get();
        $calles = Calle::where('tipo', 'CALLE')->get();
        $avenidas = Calle::where('tipo', 'AVENIDA')->get();
        $zonas = Zona::all();
        return view('admin/admin-intersections')
            ->with('intersecciones', $intersecciones)
            ->with('calles', $calles)
            ->with('avenidas', $avenidas)
            ->with('zonas', $zonas);
    }

    public function create(Request $request)
    {
        $request->validate([
            'calle_interseccion' => 'required|exists:calle,id',
            'avenida_interseccion' => 'required|exists:calle,id',
            'numero_zona' => 'required|integer|min:1',
        ]);

        $id_calle = request()->calle_interseccion;
        $id_avenida = request()->avenida_interseccion;

        $auxi = Interseccion::where('id_avenida', $id_avenida)
            ->where('id_calle', $id_calle)->with(['calle', 'avenida'])->first();

        if ($auxi) {
            return back()->with('msg-danger', 'La interseccion ya existe.');
        }

        $interseccion = new Interseccion();
        $interseccion->id_calle = $id_calle;
        $interseccion->id_avenida = $id_avenida;
        $interseccion->zona = request()->numero_zona;
        $interseccion->estado = 1;
        $nombre_calle = Calle::find($id_calle)->nombre_calle;
        $nombre_avenida = Calle::find($id_avenida)->nombre_calle;

        $interseccion->nombre = 'Interseccion ' . $nombre_calle . ' y ' . $nombre_avenida;

        try {
            $interseccion->save();
            for ($i = 0; $i < 4; $i++) {
                $semaforo = new Semaforo();
                $semaforo->id_interseccion = $interseccion->id;
                $semaforo->tiempo_verde = 60;
                $semaforo->tiempo_amarillo = 5;
                $semaforo->tiempo_rojo = 65;
                $semaforo->estado = 1;
                $semaforo->save();

                $sensor = new Sensor();
                $sensor->tipo_sensor = 'Sensor de flujo vehicular';
                $sensor->id_semaforo = $semaforo->id;
                $sensor->estado = 1;
                $sensor->save();
            }
            return back()->with('msg-success', 'Se ha registrado la intersección correctamente.');
        } catch (\Exception $e) {
            return back()->with('msg-danger', 'Error al intentar guardar la intersección.');
        }

    }

    public function startInteraction()
    {
        $registros = RegistroVehiculo::registrosPorInterseccion(\request()->id_interseccion);

        $archivos = ArchivoRegistro::select([
            'id', 'fecha', 'hora_inicio', 'hora_finalizacion', 'id_usuario', 'tipo'
        ])
            ->distinct()
            ->whereHas('registros.sensor.semaforo.interseccion', function ($query) {
                $query->where('id', \request()->id_interseccion);
            })
            ->with(['registros'])
            ->get();

        return view('monitor/monitor-interaccion')
            ->with('interseccion', Interseccion::find(request()->id_interseccion))
            ->with('registros', $registros)
            ->with('id_interseccion', request()->id_interseccion)
            ->with('archivos', $archivos);


    }

    public function getIntersecciones()
    {
        return Interseccion::all();
    }
}
