<?php

namespace App\Http\Controllers;

use App\Models\Interseccion;
use Illuminate\Http\Request;

class InterseccionController extends Controller
{
    //
    public function index()
    {
        /*$intersecciones = Interseccion::with(['calle', 'avenida'])
            ->get()
            ->map(function($interseccion) {
                return [
                    'id' => $interseccion->id,
                    'nombre' => $interseccion->nombre,
                    'calle' => $interseccion->calle ? $interseccion->calle->nombre_calle : null,
                    'avenida' => $interseccion->avenida ? $interseccion->avenida->nombre_calle : null,
                ];
            });*/

        $intersecciones = Interseccion::with(['calle', 'avenida'])->get();

        return view('admin/admin-intersections')->with('intersecciones',$intersecciones);
    }

    public function getIntersecciones(){
        return Interseccion::all();
    }
}
