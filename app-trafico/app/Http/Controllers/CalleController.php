<?php

namespace App\Http\Controllers;

use App\Models\Calle;
use Illuminate\Http\Request;

class CalleController extends Controller
{
    //
    public function index()
    {
        $calles = Calle::with(['municipio'])->get();
        return view('admin/admin-streets')->with('calles', $calles);
    }
}
