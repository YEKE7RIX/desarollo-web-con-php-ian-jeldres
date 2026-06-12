<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {

    if(session()->has('usuario')){
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::get('/login',[AuthController::class,'login'])
->name('login');

Route::post('/auth',[AuthController::class,'auth'])
->name('auth');

Route::post('/logout',[AuthController::class,'logout'])
->name('logout');

Route::get('/dashboard',[DashboardController::class,'index'])
->name('dashboard');

Route::get('/productos',[ProductoController::class,'index'])
->name('productos.index');

Route::get('/productos/crear',[ProductoController::class,'create'])
->name('productos.create');

Route::post('/productos',[ProductoController::class,'store'])
->name('productos.store');

Route::patch('/productos/{producto}/estado',
[ProductoController::class,'cambiarEstado'])
->name('productos.estado');