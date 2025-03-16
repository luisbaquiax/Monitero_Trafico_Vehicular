<?php

namespace App\Http\Controllers;

use App\Models\Calle;
use App\Models\Municipio;
use Illuminate\Http\Request;

class CalleController extends Controller
{
    //
    public function index()
    {
        $calles = Calle::with(['municipio'])->get();
        return view('admin/admin-streets')->with('calles', $calles);
    }

    public function create(Request $request)
    {
        $municipios = Municipio::first();
        $request->validate([
            'nombre_calle' => 'required | max:255',
            'tipo_calle' => 'required|in:CALLE,AVENIDA'
        ]);
        $calle = new Calle();
        $calle->nombre_calle = $request->nombre_calle;
        $calle->tipo = $request->tipo_calle;
        $calle->id_municipio = $municipios->id;
        $calle->estado = 1;
        try {
            $calle->save();
            return back()->with('msg-success', 'Calle registrada exitosamente.');
        }catch (\Exception $exception){
            return back()->with('msg-danger', 'Hubo un error al registrar la calle.');
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'nombre_calle' => 'required | max:255',
            'tipo_calle' => 'required|in:CALLE,AVENIDA'
        ]);
        $calle = Calle::find($request->id_calle);
        $calle->nombre_calle = $request->nombre_calle;
        $calle->tipo = $request->tipo_calle;

        try {
            $calle->save();
            return back()->with('msg-success', 'Calle actualizada exitosamente.');
        }catch (\Exception $exception){
            return back()->with('msg-danger', 'Hubo un error al guardar los cambios.');
        }
    }
}
