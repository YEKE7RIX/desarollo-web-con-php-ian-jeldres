<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        if(!session()->has('usuario')){
            return redirect()->route('login');
        }

        $buscar = $request->buscar;

        $productos = Producto::when($buscar, function($query) use ($buscar){

            $query->where(
                'nombre',
                'like',
                '%' . $buscar . '%'
            );

        })->get();

        return view(
            'productos.index',
            compact(
                'productos',
                'buscar'
            )
        );
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
        $request->validate([
            'nombre' => 'required|max:100',
            'categoria' => 'required|max:50',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'required|max:255'
        ], [
            'nombre.required' => 'Debe ingresar el nombre del producto.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
            'categoria.required' => 'Debe seleccionar una categoría.',
            'categoria.max' => 'La categoría es demasiado larga.',
            'precio.required' => 'Debe ingresar un precio.',
            'precio.numeric' => 'El precio debe ser numérico.',
            'precio.min' => 'El precio no puede ser negativo.',
            'stock.required' => 'Debe ingresar stock.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',
            'descripcion.required' => 'Debe ingresar una descripción.',
            'descripcion.max' => 'La descripción no puede superar los 255 caracteres.'
        ]);
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

        return view(
            'productos.edit',
            compact('producto')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'categoria' => 'required|max:50',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'required|max:255'
        ]);
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