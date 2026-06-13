<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        if(!session()->has('usuario')){
            return redirect()->route('login');
        }

        $productos = Producto::all();

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        if(!session()->has('usuario')){
            return redirect()->route('login');
        }

        return view('productos.create');
    }

    public function store(Request $request)
    {
        Producto::create([

            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'descripcion' => $request->descripcion,
            'estado' => true

        ]);

        return redirect()->route('productos.index');
    }

    public function cambiarEstado($id)
    {
        $producto = Producto::findOrFail($id);

        $producto->estado = !$producto->estado;

        $producto->save();

        return response()->json([
            'success' => true
        ]);
    }
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $producto->update([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('productos.index');
    }
}