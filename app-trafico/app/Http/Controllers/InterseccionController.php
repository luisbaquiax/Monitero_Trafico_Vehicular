<?php

namespace App\Http\Controllers;

use App\Models\Calle;
use App\Models\Interseccion;
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
            ->with('intersecciones',$intersecciones)
            ->with('calles',$calles)
            ->with('avenidas',$avenidas)
            ->with('zonas',$zonas);
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

        if($auxi){
            return back()->with('msg-danger','La interseccion ya existe.');
        }

        $interseccion = new Interseccion();
        $interseccion->id_calle = $id_calle;
        $interseccion->id_avenida  = $id_avenida;
        $interseccion->zona = request()->numero_zona;
        $nombre_calle = Calle::find($id_calle)->nombre_calle;
        $nombre_avenida = Calle::find($id_avenida)->nombre_calle;

        $interseccion->nombre = 'Interseccion '.$nombre_calle.' y '.$nombre_avenida;

        try {
            $interseccion->save();
            return back()->with('msg-success','Se ha registrado la intersección correctamente.');
        }catch (\Exception $e){
            return back()->with('msg-danger','Error al intentar guardar la intersección.');
        }

    }

    public function getIntersecciones(){
        return Interseccion::all();
    }
}
