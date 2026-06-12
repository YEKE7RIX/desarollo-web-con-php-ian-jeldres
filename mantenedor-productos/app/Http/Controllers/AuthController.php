<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $correo = $request->correo;
        $password = $request->password;

        if(
            $correo === 'admin@crm.cl'
            &&
            $password === '123456'
        ){
            session([
                'usuario' => 'Administrador'
            ]);

            return redirect()->route('dashboard');
        }

        return redirect()->route('login')
        ->with('error','Credenciales incorrectas');
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login');
    }
}