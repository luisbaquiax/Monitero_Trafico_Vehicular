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
use \App\Http\Controllers\ArchivoRegistroController;

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
Route::get('/admin-verFlujo', function (){
    return view('admin/select-intersection')->with('intersecciones', Interseccion::all());
})->name('admin.verFlujo');
Route::post('/monitor-viewRegisgers', [RegistroVehiculoController::class, 'registroVehiculos'])
    ->name('monitor.viewRegisgers');

Route::get('/adminflujo-Vehicular/{id_interseccion}', [RegistroVehiculoController::class, 'registrosVehiculares'])
    ->name('admin.flujoVehicular');

//supervisores
Route::get('/monitors-list', [UsuarioController::class, 'monitorsList'])->name('monitors.list');
Route::get('/monitor-sessions/{id_usuario}', [SesionController::class, 'sessionesPorUsuario'])
    ->name('monitor.sessions');
Route::get('/monitor-pruebas/{id_usuario}', [PruebaController::class, 'pruebasPorUsuario'])
    ->name('monitor.pruebas');
Route::get('monitor-files/{id_usuario}', [ArchivoRegistroController::class, 'archivosPorUsuario'])
    ->name('monitor.files');

//monitores
Route::get('/monitor-home', function () {
    return view('monitor.home-monitor')->with('intersecciones', Interseccion::all());
})->name('monitor.home');

Route::post('/monitor-startIteraccion', [InterseccionController::class, 'startInteraction'])
    ->name('monitor.startIteraccion');

Route::post('/monitor-cargar-datos', [RegistroVehiculoController::class, 'cargarDatos'])
    ->name('cargar.datos');

Route::post('/monitor-datosRandom', [RegistroVehiculoController::class, 'cargarRegistrosAleatorios'])
    ->name('monitor.datosRandom');

Route::get('/monitor.myFiles', [ArchivoRegistroController::class, 'monitorArchivos'])
    ->name('monitor.myFiles');

//intersecciones
Route::get('/intersecciones', [InterseccionController::class, 'index'])->name('list.interseccion');
Route::post('crate-intersection', [InterseccionController::class, 'create'])->name('create.intersection');

//calles y avenidas
Route::get('/calles', [CalleController::class, 'index'])->name('list.calle');
Route::post('/create-street', [CalleController::class, 'create'])->name('create.street');
Route::post('/edit-street', [CalleController::class, 'edit'])->name('edit.street');
