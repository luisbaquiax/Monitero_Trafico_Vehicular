<?php

use App\Models\Interseccion;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UsuarioController;
use \App\Http\Controllers\InterseccionController;
use \App\Http\Controllers\CalleController;
use \App\Http\Controllers\MunicipioController;
use \App\Http\Controllers\DepartamentoController;
use \App\Http\Controllers\SemaforoController;
use \App\Http\Controllers\SensorController;
use \App\Http\Controllers\SesionController;
use \App\Http\Controllers\PruebaController;
use \App\Http\Controllers\RegistroVehiculoController;

Route::get('/', function () {
    return view('login');
});

//users
Route::post('/user-search', [UsuarioController::class, 'search'])->name('user.search');
Route::get('/user-list', [UsuarioController::class, 'logout'])->name('users.logout');

//admin
Route::get('/users-list', [UsuarioController::class, 'usersList'])->name('users.list');
Route::get('/delete-user/{id_user}', [UsuarioController::class, 'deleteUser'])->name('delete.user');
Route::post('/create-user', [UsuarioController::class, 'create'])->name('create.user');

//supervisores
Route::get('/monitors-list', [UsuarioController::class, 'monitorsList'])->name('monitors.list');
Route::get('/monitor-sessions/{id_usuario}', [SesionController::class, 'sessionesPorUsuario'])
    ->name('monitor.sessions');
Route::get('/monitor-pruebas/{id_usuario}', [PruebaController::class, 'pruebasPorUsuario'])
    ->name('monitor.pruebas');

//monitores
Route::get('/monitor-home', function () {
    return view('monitor.home-monitor')->with('intersecciones', Interseccion::all());
})->name('monitor.home');

Route::post('/monitor-startIteraccion', [InterseccionController::class, 'startInteraction'])
    ->name('monitor.startIteraccion');

Route::post('/monitor-cargar-datos', [RegistroVehiculoController::class, 'cargarDatos'])
    ->name('cargar.datos');

//intersecciones
Route::get('/intersecciones', [InterseccionController::class, 'index'])->name('list.interseccion');
Route::post('crate-intersection', [InterseccionController::class, 'create'])->name('create.intersection');

//calles y avenidas
Route::get('/calles', [CalleController::class, 'index'])->name('list.calle');
Route::post('/create-street', [CalleController::class, 'create'])->name('create.street');
Route::post('/edit-street', [CalleController::class, 'edit'])->name('edit.street');
