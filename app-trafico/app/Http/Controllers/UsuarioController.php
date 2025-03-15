<?php

namespace App\Http\Controllers;

use App\Models\RolUsuario;
use App\Models\Usuario;
use Illuminate\Http\Request;

date_default_timezone_set("America/Guatemala");

class UsuarioController extends Controller
{

    public function create()
    {
        $user = new Usuario();
        $user->password = request('password');
        $user->nombre_usuario = request('username');
        $user->nombres = request('nombres');
        $user->apellidos = request('apellidos');
        $user->correo = request('correo');
        $user->telefono = request('telefono');
        $user->fecha_creacion = date('Y-m-d H');
        $user->estado = 1;
        $user->id_rol = request('rol');
        $user->save();

        return back()->with('msg', 'Usuario registrado correctamente.')->with('users', $this->getUsers());
    }

    public function search()
    {
        $password = request('password');
        $username = request('username');

        $user = Usuario::where('nombre_usuario', $username)->first();
        if ($user) {
            if ($user->password == $password) {
                session(['user' => $user]);
                $rol = RolUsuario::find($user->id_rol);
                switch ($rol->nombre_rol) {
                    case 'ADMINISTRADOR':
                        return view('admin/home-admin')->with('user', $user);
                    case 'MONITOR':
                        return view('monitor/home-monitor')->with('user', $user);
                    case 'SUPERVISOR':
                        return view('supervisor/home-supervisor')->with('user', $user);
                }
            } else {
                return redirect('/')->with('msg-danger', 'Contraseña inválida');
            }
        }
        //usuario no identificado
        return redirect('/')->with('msg-danger', 'Usted no se encuentra registrado en el sistema');
        //return view('welcome');
    }

    public function usersList()
    {
        return view('admin/admin-users')->with('users', $this->getUsers());
    }

    public function deleteUser($id_user)
    {
        $user = Usuario::find($id_user);
        $user->estado = 0;
        $user->save();
        return back()->with('msg-success', 'Usuario eliminado')->with('users', $this->getUsers());
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    /**
     * @return mixed Usuarios que no son de tipo ADMINISTRADOR
     */
    public function getUsers()
    {
        return Usuario::where('id_rol', '!=', 1)->where('estado', 1)->get();
    }
}
