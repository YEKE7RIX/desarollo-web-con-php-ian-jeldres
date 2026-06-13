<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function login()
    {
        // Si ya existe una sesión activa, no permite volver al login.
        if (session()->has('usuario')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function auth(Request $request)
    {
        // Validar que los datos hayan sido enviados correctamente.
        $datos = $request->validate(
            [
                'correo' => 'required|email',
                'password' => 'required|string',
            ],
            [
                'correo.required' => 'Debe ingresar el correo electrónico.',
                'correo.email' => 'Debe ingresar un correo electrónico válido.',
                'password.required' => 'Debe ingresar la contraseña.',
            ]
        );

        /*
         * Credenciales de demostración.
         */
        $correoValido = 'admin@crm.cl';
        $passwordValida = '123456';

        if (
            $datos['correo'] === $correoValido &&
            $datos['password'] === $passwordValida
        ) {
            /*
             * Regenera el identificador de sesión.
             * Esto ayuda a evitar ataques de fijación de sesión.
             */
            $request->session()->regenerate();

            // Crear variables de sesión.
            $request->session()->put([
                'usuario' => 'Administrador',
                'correo' => $datos['correo'],
            ]);

            return redirect()
                ->route('dashboard')
                ->with('success', 'Bienvenido a CRM de Productos y Precios.');
        }

        return redirect()
            ->route('login')
            ->withInput($request->only('correo'))
            ->with('error', 'El correo o la contraseña son incorrectos.');
    }

    public function logout(Request $request)
    {
        // Eliminar todas las variables almacenadas en la sesión.
        $request->session()->flush();

        // Invalidar la sesión y generar un nuevo identificador.
        $request->session()->invalidate();

        // Regenerar el token CSRF.
        $request->session()->regenerateToken();

        $respuesta = redirect()
            ->route('login')
            ->with('success', 'La sesión fue cerrada correctamente.');

        /*
         * Eliminar específicamente la cookie utilizada por
         * la sesión de Laravel.
         */
        return $respuesta->withCookie(
            Cookie::forget(config('session.cookie'))
        );
    }
}