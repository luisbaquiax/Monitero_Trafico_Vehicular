<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UsuarioController;
use \App\Http\Controllers\InterseccionController;
use \App\Http\Controllers\CalleController;
use \App\Http\Controllers\MunicipioController;
use \App\Http\Controllers\DepartamentoController;
use \App\Http\Controllers\SemaforoController;
use \App\Http\Controllers\SensorController;

Route::get('/', function () {
    return view('login');
});

//users
Route::post('/user-search',[UsuarioController::class, 'search'] )->name('user.search');
Route::get('/user-list',[UsuarioController::class, 'logout'] )->name('users.logout');

//admin
Route::get('/users-list',[UsuarioController::class, 'usersList'] )->name('users.list');
Route::get('/delete-user/{id_user}',[UsuarioController::class, 'deleteUser'] )->name('delete.user');
Route::post('/create-user',[UsuarioController::class, 'create'] )->name('create.user');

//intersecciones
Route::get('/intersecciones',[InterseccionController::class, 'index'] )->name('list.interseccion');

//calles y avenidas
Route::get('/calles',[CalleController::class, 'index'] )->name('list.calle');
