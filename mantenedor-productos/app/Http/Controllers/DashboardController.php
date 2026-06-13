<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class DashboardController extends Controller
{
    public function index()
    {
        if(!session()->has('usuario')){
            return redirect()->route('login');
        }

        $totalProductos = Producto::count();

        $productosActivos = Producto::where(
            'estado',
            true
        )->count();

        $productosInactivos = Producto::where(
            'estado',
            false
        )->count();

        return view('dashboard', compact(
            'totalProductos',
            'productosActivos',
            'productosInactivos'
        ));
    }
}